<?php 
class Reserva extends ReservaEntity {
    public static function getUltimaReservaCliente($cliente){

        global $pdo;

        $sqlWhere = "";


        $sql = "select * 
                FROM reserva 
                WHERE reserva_id = (select max(reserva_id) from reserva where cliente_id  = '".$cliente."')  ". $sqlWhere ." ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();
        if ($row) {
            return new Reserva($row);
        } else {
            return null;
        }
    }

    public static function getUltimaReservaClienteConfirmada($cliente){

        global $pdo;

        $sqlWhere = "";


        $sql = "select * 
                FROM reserva 
                WHERE reserva_id = (select max(reserva_id) from reserva where cliente_id  = '".$cliente."' and reserva_estado = '".APROBADA."' )  ". $sqlWhere ." ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();
        if ($row) {
            return new Reserva($row);
        } else {
            return null;
        }
    }

    public function getInformacionReserva(){
        $objSalida = new stdClass();

        $cancha = Cancha::getById($this->cancha_id);
        $proveedor = Proveedor::getById($cancha->proveedor_id);
        $deporte = Deporte::getById($cancha->deporte_id);

        $objSalida->provider_name = $proveedor->proveedor_nombre;
        $objSalida->provider_address = $proveedor->proveedor_direccion;
        $objSalida->reservation_date = Utility::obtenerFechaLeible($this->reserva_fechaprogramacion, false);
        $objSalida->reservation_schedule = "de " . Utility::getFechaSegunFormato($this->reserva_horainicio,"H:i") .  " a " . Utility::getFechaSegunFormato($this->reserva_horafin,"H:i") . "hrs";
        $objSalida->sportplatform_name = $cancha->cancha_nombre;
        $objSalida->sportplatform_size = Cancha::getSizeText($cancha->cancha_size);
        $objSalida->sportplatform_category = $deporte->deporte_nombre;
        $objSalida->reservation_id = $this->reserva_id;
        $objSalida->reservation_type = $this->reserva_tipo;
        $objSalida->reservation_state = $this->reserva_estado;
        $objSalida->reservation_missingPayment = Reserva::getMontoFaltanteReserva($this->reserva_id);
        $objSalida->reservation_payment = Reserva::getMontoPagadoReserva($this->reserva_id);
        $objSalida->reservation_motiveCancel = $this->reserva_motivorechazo;
        $objSalida->provider_lat = $proveedor->getProveedor_latitud();
        $objSalida->provider_lng = $proveedor->getProveedor_longitud();

        if(Security::getTokenProveedorObj() != null){

            $objSalida->reservation_amountPayment = Utility::formatearNumeroSimbolo($this->reserva_total - $this->getReserva_comision());
            $objSalida->reservation_payment = Utility::formatearNumero($objSalida->reservation_payment - $this->getReserva_comision());

        }else{
            $objSalida->reservation_amountPayment = Utility::formatearNumeroSimbolo($this->reserva_total);
        }

        if($this->getReserva_tipo() == TIPO_RESERVA_MANUAL){

            $objSalida->reservation_paymentMethod = Utility::getDescripcionTipoPagoTxt($this->reserva_tipopago);

        }else{

            $objSalida->reservation_paymentMethod = "App";

        }


        $objSalida->reservation_paymentVoucher = null;

        if($this->reserva_tipopago == PAGO_DEPOSITO && $this->reserva_urlvoucher){
            $objSalida->reservation_paymentVoucher = $this->reserva_urlvoucher;
        }
        return $objSalida;
    }

    public static function getMontoFaltanteReserva($reserva_id){
        global $pdo;



        $sqlWhere = "";


        $sql = "select coalesce(reserva_total, 0) - coalesce(sum(reservapago_monto),0)  as total
                FROM reservapago rp
                inner join reserva r on r.reserva_id = rp.reserva_id 
                where r.reserva_id = $reserva_id
                ".$sqlWhere."  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return Utility::formatearNumero($row);
        } else {
            return 0;
        }
    }

    public static function getMontoPagadoReserva($reserva_id){
        global $pdo;



        $sqlWhere = "";


        $sql = "select coalesce(sum(reservapago_monto),0)  as total
                FROM reservapago rp
                where rp.reserva_id = $reserva_id
                ".$sqlWhere."  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return Utility::formatearNumero($row);
        } else {
            return 0;
        }
    }

    public function getMetodoPago(){
        $array_metodo = array();

        $array_metodo[] = Utility::getDescripcionTipoPagoTxt($this->reserva_tipopago);
        if($this->reserva_tipopago == PAGO_DEPOSITO && $this->reserva_urlvoucher){
            $array_metodo[] = $this->reserva_urlvoucher;
        }


        return $array_metodo;
    }

    public static function getHistorialReservaCliente($cliente_id, $obj = null, $pagina = 0, $registros = 0)
    {
        global $pdo;
        $reserva_vector = array();
        $sqlWhere = "";
        $start = (int)(($pagina - 1) * $registros);
        $limit = (int)$registros;
        if ($cliente_id != PARAM_ESTADO_TODOS) {
            $sqlWhere = $sqlWhere . " and r.cliente_id = $cliente_id ";
        }
        $sqlLimit = "";
        if ($limit != 0 && $limit != -1) {
            $sqlLimit = " LIMIT :start, :limit ";
        }
        if(isset($obj->fecha) && $obj->fecha != REST_TODOS){

            if(isset($obj->fechaFinal) && $obj->fechaFinal != REST_TODOS){

                $sqlWhere.= " and date(r.reserva_fecha) >= '$obj->fecha' and date(r.reserva_fecha) <= '$obj->fechaFinal' ";

            }else{

                $sqlWhere.= " and date(r.reserva_fecha) = '$obj->fecha' ";
            }
        }

        $sqlOrden = " order by r.reserva_fechaprogramacion desc ";

        $sql = "SELECT SQL_CALC_FOUND_ROWS r.*, p.proveedor_nombre, c.cancha_nombre, '' as deporte_nombre 
                from reserva r
                inner join cancha c on r.cancha_id = c.cancha_id
                inner join proveedor p on p.proveedor_id = c.proveedor_id              
                where (reserva_estado = '".FINALIZADA."' or reserva_estado = '".CANCELADO."')  " . $sqlWhere . " " . $sqlOrden . " " . $sqlLimit;
        $stmt = $pdo->prepare($sql);

        //exit($sql);

        if ($limit != 0 && $limit != -1) {
            $stmt->bindValue(':start', $start, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        }
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $result = $pdo->query("SELECT FOUND_ROWS() AS totalCount");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        while ($reserva = $stmt->fetch()) {
            $reserva_vector[] = $reserva;
        }
        return array("reserva_array" => $reserva_vector, "totalCount" => $row["totalCount"]);
    }

    public static function reservasPanelPaginado($pagina = 0, $registros = 0, $fechaReserva, $obj = null)
    {
        global $pdo;
        $reserva_vector = array();
        $sqlWhere = "";
        $start = (int)(($pagina - 1) * $registros);
        $limit = (int)$registros;

        $sqlLimit = "";
        if ($limit != 0 && $limit != -1) {
            $sqlLimit = " LIMIT :start, :limit ";
        }
        if(isset($obj->estado) && $obj->estado != REST_TODOS){
            $sqlWhere.= " and r.reserva_estado = '$obj->estado' ";
        }

        if($fechaReserva == "1"){

            if(isset($obj->estado) && $obj->estado != PENDIENTE_CONFIRMAR_PAGO && isset($obj->fechainicio) && $obj->fechainicio != REST_TODOS && isset($obj->fechafin) && $obj->fechafin != REST_TODOS){
                $sqlWhere.= " and r.reserva_fechaprogramacion >= '". $obj->fechainicio."' and r.reserva_fechaprogramacion <= '". $obj->fechafin ."' ";
            }

        }else{

            if(isset($obj->estado) && $obj->estado != PENDIENTE_CONFIRMAR_PAGO && isset($obj->fechainicio) && $obj->fechainicio != REST_TODOS && isset($obj->fechafin) && $obj->fechafin != REST_TODOS){
                $sqlWhere.= " and r.reserva_fecha >= '". $obj->fechainicio."' and r.reserva_fecha <= '". $obj->fechafin ."' ";
            }

        }
        if(isset($obj->cliente) && $obj->cliente != REST_TODOS){
            $sqlWhere .= " and ( cl.cliente_nombres like :cliente or cl.cliente_apellidos like :cliente 
            or cl.cliente_telefono like :cliente or r.reserva_id = '".$obj->cliente."' )";
        }
        if(isset($obj->proveedor) && $obj->proveedor != REST_TODOS){
            $sqlWhere .= " and ( p.proveedor_nombre like :proveedor)";
        }

        $sqlOrden = " order by r.reserva_id desc ";

        $sql = "SELECT SQL_CALC_FOUND_ROWS *
                from reserva r
                inner join cancha c on r.cancha_id = c.cancha_id
                inner join proveedor p on p.proveedor_id = c.proveedor_id 
                inner join cliente cl on cl.cliente_id = r.cliente_id 
                where 1=1   " . $sqlWhere . " " . $sqlOrden . " " . $sqlLimit;
        $stmt = $pdo->prepare($sql);

        if(isset($obj->cliente) && $obj->cliente != REST_TODOS){
            $stmt->bindValue(':cliente', "%".$obj->cliente."%", PDO::PARAM_STR);
        }
        if(isset($obj->proveedor) && $obj->proveedor != REST_TODOS){
            $stmt->bindValue(':proveedor', "%".$obj->proveedor."%", PDO::PARAM_STR);
        }

        if ($limit != 0 && $limit != -1) {
            $stmt->bindValue(':start', $start, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        }
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $result = $pdo->query("SELECT FOUND_ROWS() AS totalCount");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        while ($reserva = $stmt->fetch()) {
            $reserva_vector[] = $reserva;
        }
        return array("reserva_array" => $reserva_vector, "totalCount" => $row["totalCount"]);
    }

    public static function validarReserva($objReserva, $cancha_id, $proveedor_id)
    {

        $mensajes = array();

        if (!isset($objReserva->reserva)) {
            $mensajes[] = "Los datos recibidos no cumplen el formato esperado";
            return $mensajes;
        }

        if (!isset($objReserva->address)) {
            $mensajes[] = "Los datos recibidos no cumplen el formato esperado";
            return $mensajes;
        }

        if(!isset($objReserva->reserva->cliente_id)) {
            $mensajes[] = "El cliente_id es obligatorio";
            return $mensajes;
        }


        $objCliente = Cliente::getById($objReserva->reserva->cliente_id);
        if(!$objCliente){
            $mensajes[] = "El cliente no existe";
            return $mensajes;
        }

        if(Clienteproveedor::clienteInactivoProveedor($objCliente->cliente_id, $proveedor_id)){
            $mensajes[] = "El cliente esta inhabilitado para reservar con este centro deportivo.";
            return $mensajes;
        }

        /*if($objCliente && $objCliente->cliente_telefono == null || $objCliente->cliente_telefono == ""){
            $mensajes[] = "El número de telefono es requerido";
            return $mensajes;
        }*/

        if (!isset($objReserva->reserva->reserva_fechaprogramacion)) {
            $mensajes[] = "La fecha de programacion de la reserva es obligatorio.";
            return $mensajes;
        }

        if (!Utility::esFechaValida($objReserva->reserva->reserva_fechaprogramacion,"Y-m-d")) {
            $mensajes[] = "La fecha de programacion no es válida.";
            return $mensajes;
        }

        if (!isset($objReserva->reserva->reserva_horainicio)) {
            $mensajes[] = "La hora de inicio de la reserva es obligatorio.";
            return $mensajes;
        }

        if (!isset($objReserva->reserva->reserva_horafin)) {
            $mensajes[] = "La hora de fin de la reserva es obligatorio.";
            return $mensajes;
        }

        if($objReserva->reserva->reserva_fechaprogramacion == Utility::getFechaActual()){
            if(Utility::fechaAesMayorFechab(Utility::getFechaHoraActual(),$objReserva->reserva->reserva_fechaprogramacion . " " . Utility::formatearHoraSinSegundos($objReserva->reserva->reserva_horainicio), false)){
                $mensajes[] = "La hora de inicio debe ser mayor a la actual.";
                return $mensajes;
            }
        }elseif (Utility::fechaAesMayorFechab(Utility::getFechaActual(), $objReserva->reserva->reserva_fechaprogramacion)){
            $mensajes[] = "La fecha de reserva debe ser mayor o igual a la fecha actual.";
            return $mensajes;
        }



        /*if (!Utility::horaAesMayorHorab($objReserva->reserva->reserva_horafin, $objReserva->reserva->reserva_horainicio, false)) {
            $mensajes[] = "La hora de fin debe ser mayor a la de inicio.";
            return $mensajes;
        }*/

        if(!isset($objReserva->reserva->reserva_tipopago)  || $objReserva->reserva->reserva_tipopago == null
            || $objReserva->reserva->reserva_tipopago == ""){
            $mensajes[] = "El tipo de pago es obligatorio";
            return $mensajes;
        }

        if($objReserva->reserva->reserva_tipopago == PAGO_DEPOSITO && (!isset($objReserva->reserva->reserva_urlvoucher)  || empty($objReserva->reserva->reserva_urlvoucher))){
            $mensajes[] = "El voucher es obligatorio";
            return $mensajes;
        }

        if($objReserva->reserva->reserva_tipopago == PAGO_ENLINEA && (!isset($objReserva->reserva->reserva_niubiz)  || empty($objReserva->reserva->reserva_niubiz))){
            $mensajes[] = "Los datos de niubiz es obligatorio";
            return $mensajes;
        }

        if (!isset($objReserva->address->address_latitud)) {
            $mensajes[] = "La address_latitud es obligatorio";
            return $mensajes;
        }

        if (!isset($objReserva->address->address_longitud)) {
            $mensajes[] = "La address_longitud es obligatorio";
            return $mensajes;
        }

        if (!isset($objReserva->address->address_direccionusuario)) {
            $mensajes[] = "El address_direccionusuario es obligatorio";
            return $mensajes;
        }

        if(!Reserva::validarFechaReservaDisponible($cancha_id, $objReserva->reserva->reserva_fechaprogramacion, $objReserva->reserva->reserva_horainicio, $objReserva->reserva->reserva_horafin)){
            $mensajes[] = "La Reserva que deseá realizar ya se encuentra ocupada..";
            return $mensajes;
        }


        return $mensajes;
    }

    public static function validarFechaReservaDisponible($cancha_id, $fecha, $horainicio, $horafin){
        global $pdo;

        $horainicio = Utility::formatearHoraSinSegundos($horainicio);
        $horafin = Utility::formatearHoraSinSegundos($horafin);
        $horainicio = Utility::addTimeToDate($fecha . " " . $horainicio, "1 seconds", "H:i:s");

        $sqlWhere = "";

        if($cancha_id != "-1"){
            $sqlWhere .= " and cancha_id = $cancha_id ";
        }

        $sql = "SELECT count(*) FROM reserva 
                where reserva_fechaprogramacion = '$fecha' ".$sqlWhere." and reserva_estado != ".CANCELADO."
            and ((:horainicio > reserva_horainicio and :horainicio <= reserva_horafin) 
                or  (:horafin > reserva_horainicio and :horafin <= reserva_horafin) 
                or  (:horainicio < reserva_horainicio and :horafin >= reserva_horafin)
                )
            ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':horainicio',	$horainicio, PDO::PARAM_STR);
        $stmt->bindParam(':horafin', $horafin, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            if($row * 1 > 0){
                return false;
            }
            return true;
        } else {
            return true;
        }
    }

    public static function validarFechaReservaPadreDisponible($cancha_id, $fecha, $horainicio, $horafin, $cancha_padreid){
        global $pdo;

        $sqlWhere = "";

        $horainicio = Utility::formatearHoraSinSegundos($horainicio);
        $horafin = Utility::formatearHoraSinSegundos($horafin);
        $horainicio = Utility::addTimeToDate($fecha . " " . $horainicio, "1 seconds", "H:i:s");

        if($cancha_padreid){
            $sqlWhere .= " and (r.cancha_id = $cancha_id or c.cancha_padreid = $cancha_id or r.cancha_id = $cancha_padreid) ";
        }else{
            $sqlWhere .= " and (r.cancha_id = $cancha_id or c.cancha_padreid = $cancha_id) ";
        }

        $sql = "SELECT count(*) 
                FROM reserva r
                inner join cancha c on r.cancha_id = c.cancha_id
                where reserva_fechaprogramacion = '$fecha' and reserva_estado != ".CANCELADO."
            and ((:horainicio > reserva_horainicio and :horainicio <= reserva_horafin) 
                or  (:horafin > reserva_horainicio and :horafin <= reserva_horafin) 
                or  (:horainicio < reserva_horainicio and :horafin >= reserva_horafin)
                )
            " . $sqlWhere;

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':horainicio',	$horainicio, PDO::PARAM_STR);
        $stmt->bindParam(':horafin', $horafin, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            if($row * 1 > 0){
                return false;
            }
            return true;
        } else {
            return true;
        }
    }

    public static function validacionDeDuplicacion($objReserva){

        $valido = false;

        $sql = " select * from reserva where cliente_id = ? 
                    and TIME_TO_SEC(TIMEDIFF('".Utility::getFechaHoraActual()."',reserva_fecha))<5
                limit 1";

        $array_reservas = Reserva::findWithQuery($sql, array($objReserva->reserva->cliente_id));

        if(sizeof($array_reservas)){
            $valido = true;
        }

        return $valido;

    }

    public static function armarReserva($objReserva, $cancha){

        $proveedor = Proveedor::getById($cancha->proveedor_id);
        $canchaprecio = $cancha->getCanchaPrecioCustom($objReserva->reserva, "reserva_horainicio", "reserva_horafin", "reserva_fechaprogramacion");

        $objReserva->reserva->reserva_horainicio = Utility::formatearHoraSinSegundos($objReserva->reserva->reserva_horainicio);

        if($objReserva->reserva->reserva_horafin == "00:00:00" || $objReserva->reserva->reserva_horafin == "00:00"){
            $objReserva->reserva->reserva_horafin = "23:59";
        }

        $objReserva->reserva->reserva_horafin = Utility::formatearHoraSinSegundos($objReserva->reserva->reserva_horafin);

        $objReserva->reserva->reserva_comision = $proveedor->calcularComisionGanada($canchaprecio);
        $objReserva->reserva->reserva_total = $canchaprecio + $objReserva->reserva->reserva_comision;
        $objReserva->reserva->reserva_precio = $canchaprecio;
        $objReserva->reserva->reserva_pagocon = $cancha->getMontoPagarReserva($objReserva->reserva, "reserva_horainicio", "reserva_horafin", "reserva_fechaprogramacion");

        return $objReserva;

    }

    public function crear($objReserva, $proveedor_id){
        $this->reserva_fecha = Utility::getFechaHoraActual();
        $this->proveedor_id = $proveedor_id;
        $this->address_id = Address::getAddressId($this->cliente_id, $objReserva->address);
        $this->reserva_estado = PENDIENTE_CONFIRMAR_PAGO;

        if($this->reserva_tipopago == PAGO_ENLINEA){
            $this->reserva_estado = APROBADA;
        }

        $this->reserva_firstorder = $this->verificarSiEsPrimeraReservaCliente();

        $this->platform_id = Platform::getPlatformID(Security::getAppId(), Security::getPlatform());

        $this->reserva_tipo = TIPO_RESERVA_APP;

        $this->reserva_canal = CANAL_RESERVA_APP;

        /**
         * Set device_id
         */
        $tokenObj = Security::getTokenObj();
        if($tokenObj) {
            $this->reserva_deviceid = $tokenObj->token_deviceid;
        }

        $this->reserva_id = $this->insert();

        Bloqueo::eliminarBloqueosCliente($this->cliente_id);

        if($this->reserva_tipopago == PAGO_ENLINEA){
            if(isset($this->reserva_niubiz)){
                Pagodata::registrarPagoData($this->reserva_niubiz, $this->reserva_id);
            }
        }

    }


    public static function validarReservaManual($objReserva, $cancha_id)
    {

        $mensajes = array();

        if (!isset($objReserva->reserva)) {
            $mensajes[] = "Los datos recibidos no cumplen el formato esperado";
            return $mensajes;
        }


        if (!isset($objReserva->reserva->reserva_cliente)) {
            $mensajes[] = "Los nombres del cliente de la reserva es obligatorio.";
            return $mensajes;
        }

        if (!isset($objReserva->reserva->reserva_telefono)) {
            $mensajes[] = "El telefono del cliente de la reserva es obligatorio.";
            return $mensajes;
        }

        if (!isset($objReserva->reserva->reserva_fechaprogramacion)) {
            $mensajes[] = "La fecha de programacion de la reserva es obligatorio.";
            return $mensajes;
        }

        if (!Utility::esFechaValida($objReserva->reserva->reserva_fechaprogramacion,"Y-m-d")) {
            $mensajes[] = "La fecha de programacion no es válida.";
            return $mensajes;
        }

        if (!isset($objReserva->reserva->reserva_horainicio)) {
            $mensajes[] = "La hora de inicio de la reserva es obligatorio.";
            return $mensajes;
        }

        if (!isset($objReserva->reserva->reserva_horafin)) {
            $mensajes[] = "La hora de fin de la reserva es obligatorio.";
            return $mensajes;
        }

        /*if (!Utility::horaAesMayorHorab($objReserva->reserva->reserva_horafin, $objReserva->reserva->reserva_horainicio, false)) {
            $mensajes[] = "La hora de fin debe ser mayor a la de inicio.";
            return $mensajes;
        }*/

        if(!isset($objReserva->reserva->reserva_tipopago)  || $objReserva->reserva->reserva_tipopago == null
            || $objReserva->reserva->reserva_tipopago == ""){
            $mensajes[] = "El tipo de pago es obligatorio";
            return $mensajes;
        }

        if($objReserva->reserva->reserva_tipopago == PAGO_ENLINEA && (!isset($objReserva->reserva->reserva_niubiz)  || empty($objReserva->reserva->reserva_niubiz))){
            $mensajes[] = "Los datos de niubiz es obligatorio";
            return $mensajes;
        }

        if (!isset($objReserva->reserva->reserva_total)) {
            $mensajes[] = "El total de la reserva es obligatorio";
            return $mensajes;
        }

        if (!isset($objReserva->reserva->reserva_pagocon)) {
            $mensajes[] = "El monto abonar es obligatorio";
            return $mensajes;
        }

        if ($objReserva->reserva->reserva_pagocon > $objReserva->reserva->reserva_total) {
            $mensajes[] = "El monto abonar es mayor al monto total.";
            return $mensajes;
        }

        if(!Reserva::validarFechaReservaDisponible($cancha_id, $objReserva->reserva->reserva_fechaprogramacion, $objReserva->reserva->reserva_horainicio, $objReserva->reserva->reserva_horafin)){
            $mensajes[] = "La Reserva ya se encuentra ocupada.";
            return $mensajes;
        }



        return $mensajes;
    }

    public static function validacionDeDuplicacionManual($objReserva){

        $valido = false;

        $sql = " select * from reserva where reserva_telefono = ? 
                    and TIME_TO_SEC(TIMEDIFF('".Utility::getFechaHoraActual()."',reserva_fecha))<60
                limit 1";

        $array_reservas = Reserva::findWithQuery($sql, array($objReserva->reserva->reserva_telefono));

        if(sizeof($array_reservas)){
            $valido = true;
        }

        return $valido;

    }

    public static function armarReservaManual($objReserva){


        $objReserva->reserva->reserva_horainicio = Utility::formatearHoraSinSegundos($objReserva->reserva->reserva_horainicio);
        $objReserva->reserva->reserva_horafin = Utility::formatearHoraSinSegundos($objReserva->reserva->reserva_horafin);
        $objReserva->reserva->reserva_comision = 0;

        return $objReserva;

    }

    public function crearManual($proveedor_id){
        $this->reserva_fecha = Utility::getFechaHoraActual();
        $this->proveedor_id = $proveedor_id;
        $this->reserva_precio = $this->reserva_total;

        $this->reserva_estado = APROBADA;

        $this->reserva_firstorder = $this->verificarSiEsPrimeraReservaClienteManual();

        $this->platform_id = Platform::getPlatformID(Security::getAppId(), Security::getPlatform());

        $this->reserva_tipo = TIPO_RESERVA_MANUAL;


        /**
         * Set device_id
         */
        $tokenObj = Security::getTokenObj();
        if($tokenObj) {
            $this->reserva_deviceid = $tokenObj->token_deviceid;
        }

        $this->reserva_id = $this->insert();

        Bloqueo::eliminarBloqueosProveedor($this->proveedor_id);

        if($this->reserva_tipopago == PAGO_ENLINEA){
            if(isset($this->reserva_niubiz)){
                Pagodata::registrarPagoData($this->reserva_niubiz, $this->reserva_id);
            }
        }

    }

    public function registrarPago($monto_pago, $tipo_pago){

        if(Utility::validarEnteroPositivo($monto_pago)){

            $pago = new Reservapago();
            $pago->reserva_id = $this->reserva_id;
            $pago->reservapago_monto = $monto_pago;
            $pago->reservapago_tipo = $tipo_pago;
            $pago->reservapago_fecha = Utility::getFechaHoraActual();
            $pago->insert();

        }

    }


    public function verificarSiEsPrimeraReservaCliente(){
        $esPrimeraReserva = NO;
        $sql = "select coalesce(count(*),0) as total from reserva where cliente_id = ?";
        $reserva = Reserva::findWithQuery($sql, array($this->cliente_id));
        if(sizeof($reserva)){
            $objDelivery = $reserva[0];
            if($objDelivery->total * 1 == 0){
                $esPrimeraReserva = SI;
            }
        }

        return $esPrimeraReserva;
    }
    public function verificarSiEsPrimeraReservaClienteManual(){
        $esPrimeraReserva = NO;
        $sql = "select coalesce(count(*),0) as total from reserva where reserva_telefono = ?";
        $reserva = Reserva::findWithQuery($sql, array($this->reserva_telefono));
        if(sizeof($reserva)){
            $objDelivery = $reserva[0];
            if($objDelivery->total * 1 == 0){
                $esPrimeraReserva = SI;
            }
        }

        return $esPrimeraReserva;
    }

    public static function obtenerCalculoRatingProveedor($proveedor_id){

        global $pdo;

        $rating =  0;

        $sql = "SELECT coalesce(sum(reserva_rating),0) as reserva_rating, count(*) as total_reservas  from reserva 
                where proveedor_id= $proveedor_id and reserva_rating > 0 and reserva_estado = ".APROBADA;

        $stmt = $pdo->prepare($sql);

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Reserva');

        if ($delivery = $stmt->fetch()) {

            $reserva_rating = $delivery->reserva_rating;
            $total_reservas = $delivery->total_reservas;

            if($total_reservas  >  0){

                $rating = Utility::redondearCalificacion($reserva_rating / $total_reservas);

            }
        }

        return $rating;

    }

    public static function totalReservasByFecha($fechainicio, $fechafin, $fechaReserva = SI){
        global $pdo;



        $sqlWhere = "";


        if($fechaReserva == SI){
            $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);
        }else{
            $sqlWhere .= Utility::sqlFechaRegistroReserva($fechainicio, $fechafin);
        }



        $sql = "select coalesce(sum(reserva_total),0) as total
                FROM reserva r 
                where r.reserva_estado != ".CANCELADO." and r.reserva_estado != ".PENDIENTE_CONFIRMAR_PAGO."
                ".$sqlWhere."  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    }

    public static function totalComisionByFecha($fechainicio, $fechafin, $fechaReserva = SI){
        global $pdo;



        $sqlWhere = "";

        if($fechaReserva == SI){
            $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);
        }else{
            $sqlWhere .= Utility::sqlFechaRegistroReserva($fechainicio, $fechafin);
        }



        $sql = "select coalesce(sum(reserva_comision),0) as total
                FROM reserva r 
                where r.reserva_estado != ".CANCELADO." and r.reserva_estado != ".PENDIENTE_CONFIRMAR_PAGO."
                ".$sqlWhere."  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    }

    public static function listaReservasByFechaParaFacturacion($proveedor_id, $fechainicio, $fechafin, $reserva_tipo = REST_TODOS){
        global $pdo;

        $proveedor_vector = array();

        $sqlWhere = "";


        $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);

        if($reserva_tipo != REST_TODOS){
            $sqlWhere .= " and r.reserva_tipo = $reserva_tipo ";
        }


        $sql = "select *
                FROM reserva r 
                where r.proveedor_id=".$proveedor_id." and r.reserva_estado != ".CANCELADO." and r.reserva_estado != ".PENDIENTE_CONFIRMAR_PAGO."
                ".$sqlWhere."  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);

        while ($proveedor = $stmt->fetch()) {
            $proveedor_vector[] = $proveedor;
        }

        return $proveedor_vector;
    }

    public static function cantidadTotaReservasByFecha($fechainicio, $fechafin, $proveedor_id = REST_TODOS, $deporte_id = REST_TODOS, $fechaReserva = SI){
        global $pdo;



        $sqlWhere = "";


        if($fechaReserva == SI){
            $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);
        }else{
            $sqlWhere .= Utility::sqlFechaRegistroReserva($fechainicio, $fechafin);
        }

        if($proveedor_id != REST_TODOS){
            $sqlWhere .= " and r.proveedor_id = $proveedor_id ";
        }
        if($deporte_id != REST_TODOS){
            $sqlWhere .= " and c.deporte_id = $deporte_id ";
        }


        $sql = "select count(*) as total
                FROM reserva r
                inner join cancha c on c.cancha_id = r.cancha_id
                where r.reserva_estado != ".CANCELADO." and r.reserva_estado != ".PENDIENTE_CONFIRMAR_PAGO."
                ".$sqlWhere."  ";

        //exit($sql);
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return $row * 1;
        } else {
            return 0;
        }
    }

    public static function totalHorasReservadas($fechainicio, $fechafin, $proveedor_id = REST_TODOS, $deporte_id = REST_TODOS, $tipoReserva = REST_TODOS, $fechaReserva = SI){
        global $pdo;



        $sqlWhere = "";


        if($fechaReserva == SI){
            $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);
        }else{
            $sqlWhere .= Utility::sqlFechaRegistroReserva($fechainicio, $fechafin);
        }

        if($proveedor_id != REST_TODOS){
            $sqlWhere .= " and r.proveedor_id = $proveedor_id ";
        }
        if($deporte_id != REST_TODOS){
            $sqlWhere .= " and c.deporte_id = $deporte_id ";
        }

        if($tipoReserva != REST_TODOS){
            $sqlWhere .= "and r.reserva_tipo = ".$tipoReserva." ";
        }

        $sql = "select coalesce(sum(ROUND(COALESCE(TIMESTAMPDIFF(MINUTE, CONCAT(reserva_fechaprogramacion, ' ', reserva_horainicio), CONCAT(reserva_fechaprogramacion, ' ', reserva_horafin)), 0) / 60, 2)),0) as total
                FROM reserva r
                inner join cancha c on c.cancha_id = r.cancha_id 
                where r.reserva_estado != ".CANCELADO." and r.reserva_estado != ".PENDIENTE_CONFIRMAR_PAGO."
                ".$sqlWhere."  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return round($row * 1,0);
        } else {
            return 0;
        }
    }

    public static function cantidadTotaReservasCanceladasByFecha($fechainicio, $fechafin, $proveedor_id = REST_TODOS,
                                                                 $deporte_id = REST_TODOS, $appProveedor = false, $fechaReserva = SI){
        global $pdo;



        $sqlWhere = "";


        if($fechaReserva == SI){
            $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);
        }else{
            $sqlWhere .= Utility::sqlFechaRegistroReserva($fechainicio, $fechafin);
        }

        if($proveedor_id != REST_TODOS){
            $sqlWhere .= " and r.proveedor_id = $proveedor_id ";
        }
        if($deporte_id != REST_TODOS){
            $sqlWhere .= " and c.deporte_id = $deporte_id ";
        }

        if($appProveedor){
            $sqlWhere .= "and r.reserva_tipo = ".TIPO_RESERVA_MANUAL." ";
        }



        $sql = "select count(*) as total
                FROM reserva r
                inner join cancha c on c.cancha_id = r.cancha_id 
                where r.reserva_estado = ".CANCELADO." 
                ".$sqlWhere."  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    }

    public static function totalReservasByFechaTipoPago($fechainicio, $fechafin, $tipopago = REST_TODOS, $fechaReserva = SI){
        global $pdo;



        $sqlWhere = "";


        if($fechaReserva == SI){
            $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);
        }else{
            $sqlWhere .= Utility::sqlFechaRegistroReserva($fechainicio, $fechafin);
        }

        if($tipopago != REST_TODOS){
            $sqlWhere .= " and reservapago_tipo = '$tipopago' ";
        }

        $sql = "select coalesce (SUM(reservapago_monto),0) as total
                FROM reservapago rp inner join reserva r on r.reserva_id = rp.reserva_id 
                where r.reserva_estado != ".CANCELADO." and r.reserva_estado != ".PENDIENTE_CONFIRMAR_PAGO." and r.reserva_tipo = ".TIPO_RESERVA_APP."
                ".$sqlWhere."  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    }

    public static function totalComisionesReservasByFechaTipoPago($fechainicio, $fechafin, $tipopago = REST_TODOS, $fechaReserva = SI){
        global $pdo;



        $sqlWhere = "";


        if($fechaReserva == SI){
            $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);
        }else{
            $sqlWhere .= Utility::sqlFechaRegistroReserva($fechainicio, $fechafin);
        }

        if($tipopago != REST_TODOS){
            $sqlWhere .= " and reservapago_tipo = '$tipopago' ";
        }

        $sql = "select coalesce (SUM(reserva_comision),0) as total
                FROM reservapago rp inner join reserva r on r.reserva_id = rp.reserva_id 
                where r.reserva_estado != ".CANCELADO." and r.reserva_estado != ".PENDIENTE_CONFIRMAR_PAGO." and r.reserva_tipo = ".TIPO_RESERVA_APP."
                ".$sqlWhere."  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    }

    public static function totalReservasByFechaDeporte($fechainicio, $fechafin, $deporte_id = REST_TODOS, $fechaReserva = SI){
        global $pdo;



        $sqlWhere = "";


        if($fechaReserva == SI){
            $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);
        }else{
            $sqlWhere .= Utility::sqlFechaRegistroReserva($fechainicio, $fechafin);
        }

        if($deporte_id != REST_TODOS){
            $sqlWhere .= " and d.deporte_id = $deporte_id ";
        }


        $sql = "select (SUM(CASE WHEN (reservapago_tipo='1' or reservapago_tipo='2') THEN reservapago_monto else 0 END)) as total 
                FROM reservapago rp inner join reserva r on r.reserva_id = rp.reserva_id 
                inner join cancha d on r.cancha_id = d.cancha_id
                where r.reserva_estado != ".CANCELADO." and r.reserva_estado != ".PENDIENTE_CONFIRMAR_PAGO." and r.reserva_tipo = ".TIPO_RESERVA_APP."
                ".$sqlWhere."  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    }

    public static function totalComisionesByFechaDeporte($fechainicio, $fechafin, $deporte_id = REST_TODOS, $fechaReserva = SI){
        global $pdo;



        $sqlWhere = "";


        if($fechaReserva == SI){
            $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);
        }else{
            $sqlWhere .= Utility::sqlFechaRegistroReserva($fechainicio, $fechafin);
        }

        if($deporte_id != REST_TODOS){
            $sqlWhere .= " and d.deporte_id = $deporte_id ";
        }


        $sql = "select sum(r.reserva_comision) as total 
                FROM reserva r 
                inner join cancha d on r.cancha_id = d.cancha_id
                where r.reserva_estado != ".CANCELADO." and r.reserva_estado != ".PENDIENTE_CONFIRMAR_PAGO." and r.reserva_tipo = ".TIPO_RESERVA_APP."
                ".$sqlWhere."  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    }

    public static function cantidadReservasByFechaDeporte($fechainicio, $fechafin, $deporte_id = REST_TODOS, $proveedor_id = REST_TODOS){
        global $pdo;



        $sqlWhere = "";


        $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);

        if($deporte_id != REST_TODOS){
            $sqlWhere .= " and d.deporte_id = $deporte_id ";
        }

        if($proveedor_id != REST_TODOS){
            $sqlWhere .= " and r.proveedor_id = $proveedor_id ";
        }


        $sql = "select count(*) as total
                FROM reserva r 
                inner join cancha d on r.cancha_id = d.cancha_id
                where r.reserva_estado != ".CANCELADO."
                ".$sqlWhere."  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    }

    public static function totalHorasReservadasByDeporte($fechainicio, $fechafin, $deporte_id, $fechaReserva = SI){
        global $pdo;



        $sqlWhere = "";


        if($fechaReserva == SI){
            $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);
        }else{
            $sqlWhere .= Utility::sqlFechaRegistroReserva($fechainicio, $fechafin);
        }


        if($deporte_id != REST_TODOS){
            $sqlWhere .= " and d.deporte_id = $deporte_id ";
        }

        $sql = "select coalesce(sum(ROUND(COALESCE(TIMESTAMPDIFF(MINUTE, CONCAT(reserva_fechaprogramacion, ' ', reserva_horainicio), CONCAT(reserva_fechaprogramacion, ' ', reserva_horafin)), 0) / 60, 2)),0) as total
                FROM reserva r 
                inner join cancha d on r.cancha_id = d.cancha_id
                where r.reserva_estado != ".CANCELADO." and r.reserva_estado != ".PENDIENTE_CONFIRMAR_PAGO."
                ".$sqlWhere."  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return $row * 1;
        } else {
            return 0;
        }
    }

    public static function getTopProveedor($fechainicio,$fechafin, $limit = 5, $fechaReserva = SI){
        global $pdo;

        $proveedor_vector = array();
        $sqlWhere = "";


        if($fechaReserva == SI){
            $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);
        }else{
            $sqlWhere .= Utility::sqlFechaRegistroReserva($fechainicio, $fechafin);
        }

        $sql = "select p.*, (SUM(CASE WHEN (reservapago_tipo='1' or reservapago_tipo='2') THEN reservapago_monto else 0 END)) as proveedor_total
                FROM reservapago rp inner join reserva r on r.reserva_id = rp.reserva_id
                inner join proveedor p on r.proveedor_id = p.proveedor_id
                where r.reserva_estado != ".CANCELADO."  and r.reserva_estado != ".PENDIENTE_CONFIRMAR_PAGO." and r.reserva_tipo = ".TIPO_RESERVA_APP."
                ".$sqlWhere." 
                group by r.proveedor_id
                order by proveedor_total desc 
                limit $limit";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);

        while ($proveedor = $stmt->fetch()) {
            $proveedor_vector[] = $proveedor;
        }

        return $proveedor_vector;
    }

    public static function getTopComisionProveedor($fechainicio,$fechafin, $limit = 5, $fechaReserva = SI){
        global $pdo;

        $proveedor_vector = array();
        $sqlWhere = "";


        if($fechaReserva == SI){
            $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);
        }else{
            $sqlWhere .= Utility::sqlFechaRegistroReserva($fechainicio, $fechafin);
        }

        $sql = "select p.*, sum(reserva_comision) as proveedor_total
                FROM reserva r 
                inner join proveedor p on r.proveedor_id = p.proveedor_id
                where r.reserva_estado != ".CANCELADO."  and r.reserva_estado != ".PENDIENTE_CONFIRMAR_PAGO." and r.reserva_tipo = ".TIPO_RESERVA_APP."
                ".$sqlWhere." 
                group by r.proveedor_id
                order by proveedor_total desc 
                limit $limit";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);

        while ($proveedor = $stmt->fetch()) {
            $proveedor_vector[] = $proveedor;
        }

        return $proveedor_vector;
    }

    public static function getGraficoReservasDias($fechainicio,$fechafin, $fechaReserva = SI){
        $array_salida = array();

        $array_dias = Utility::getRangoFechas($fechainicio,$fechafin);

        foreach ($array_dias as $fecha){
            $dia = Utility::getFechaSegunFormato($fecha->fecha_value, "d");

            $total = Reserva::cantidadTotaReservasByFecha($fecha->fecha_value, $fecha->fecha_value, REST_TODOS, REST_TODOS, $fechaReserva);

            $array_salida[] = array(intval($dia), $total);
        }

        return $array_salida;
    }

    public function getCliente(){

        $cliente = Cliente::getById($this->getCliente_id());

        if($cliente){
            return $cliente;
        }

        return null;

    }

    public function getProveedor(){

        $proveedor = Proveedor::getById($this->getProveedor_id());

        if($proveedor){
            return $proveedor;
        }

        return null;

    }

    public function enviarNotificacion($message, $messageBig){

        try{

            $client = $this->getCliente();

            if($client){

                $data = array(
                    "message" => $message,
                    "messageBig" => $messageBig,
                    "notificationId" => $this->getreserva_id(),
                    "requireLogin" => SI,
                    "notificationType" => NOTIFICATION_CHANGE_STATE,
                    /*"pedido_latitude" => $pedido_lat,
                    "pedido_longitude" => $pedido_lon,
                    "max_distance" => $radio,*/
                );
                return $client->sendNotificacion($data, $this->getReserva_deviceid());

            }

        }catch (Exception $err){

            return false;
        }

    }

    public static function totalPagoIngresosByFecha($fechainicio, $fechafin, $proveedor_id = REST_TODOS, $deporte_id = REST_TODOS, $reserva_tipo = REST_TODOS){
        global $pdo;



        $sqlWhere = "";

        $sqlWhere .= Utility::sqlFechaPagoReserva($fechainicio, $fechafin);

        if($proveedor_id != REST_TODOS){
            $sqlWhere .= " and r.proveedor_id = $proveedor_id ";
        }
        if($deporte_id != REST_TODOS){
            $sqlWhere .= " and c.deporte_id = $deporte_id ";
        }

        if($reserva_tipo != REST_TODOS){
            $sqlWhere .= " and r.reserva_tipo = $reserva_tipo ";
        }


        $sql = "select coalesce(sum(reservapago_monto),0) as total
                FROM reservapago rp
                inner join reserva r on r.reserva_id = rp.reserva_id
                inner join cancha c on c.cancha_id = r.cancha_id 
                where r.reserva_estado != ".CANCELADO."
                ".$sqlWhere."  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return Utility::formatearNumero($row);
        } else {
            return 0;
        }
    }

    public static function totalPagoEgresosByFecha($fechainicio, $fechafin, $proveedor_id = REST_TODOS, $deporte_id = REST_TODOS, $appProveedor = PARAM_ESTADO_TODOS){
        global $pdo;



        $sqlWhere = "";

        $sqlWhere .= Utility::sqlFechaPagoReserva($fechainicio, $fechafin);

        if($proveedor_id != REST_TODOS){
            $sqlWhere .= " and r.proveedor_id = $proveedor_id ";
        }

        if($deporte_id != REST_TODOS){
            $sqlWhere .= " and c.deporte_id = $deporte_id ";
        }

        if($appProveedor == true){

            $sqlWhere .= "and r.reserva_tipo = ".TIPO_RESERVA_MANUAL." ";

        }else if($appProveedor == false){

            $sqlWhere .= "and r.reserva_tipo = ".TIPO_RESERVA_APP." ";

        }

        $sql = "select (SUM(CASE WHEN (reservapago_tipo='".PAGO_DEPOSITO."' or reservapago_tipo='".PAGO_ENLINEA."') THEN reservapago_monto else 0 END))  as total
                FROM reservapago rp
                inner join reserva r on r.reserva_id = rp.reserva_id
                inner join cancha c on c.cancha_id = r.cancha_id 
                where r.reserva_estado = ".CANCELADO."
                ".$sqlWhere."  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return Utility::formatearNumero($row);
        } else {
            return Utility::formatearNumero(0);
        }
    }

    public static function totalPagoPagarProveedorByFecha($fechainicio, $fechafin, $proveedor_id = REST_TODOS, $deporte_id = REST_TODOS,
                                                          $reserva_tipo = REST_TODOS, $porFechaReserva = NO){
        global $pdo;



        $sqlWhere = "";

        if($porFechaReserva == NO){

            $sqlWhere .= Utility::sqlFechaPagoReserva($fechainicio, $fechafin);
        }else{
            $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);
        }

        if($proveedor_id != REST_TODOS){
            $sqlWhere .= " and r.proveedor_id = $proveedor_id ";
        }

        if($deporte_id != REST_TODOS){
            $sqlWhere .= " and c.deporte_id = $deporte_id ";
        }

        if($reserva_tipo != REST_TODOS){
            $sqlWhere .= " and r.reserva_tipo = $reserva_tipo ";
        }

        $sql = "select (SUM(CASE WHEN (reservapago_tipo='".PAGO_DEPOSITO."' or reservapago_tipo='".PAGO_ENLINEA."') THEN reservapago_monto else 0 END))  as total                
                FROM reservapago rp 
                inner join reserva r on r.reserva_id = rp.reserva_id 
                inner join cancha c on c.cancha_id = r.cancha_id 
                where r.reserva_estado != ".CANCELADO." and r.reserva_estado != ".PENDIENTE_CONFIRMAR_PAGO."
                ".$sqlWhere."  ";

        //exit($sql);
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {

            return $row;

        } else {
            return Utility::formatearNumero(0);
        }
    }

    public static function totalPagoComisionesByFecha($fechainicio, $fechafin, $proveedor_id = REST_TODOS, $deporte_id = REST_TODOS,
                                                      $reserva_tipo = REST_TODOS, $porFechaReserva = NO){
        global $pdo;



        $sqlWhere = "";

        if($proveedor_id != REST_TODOS){
            $sqlWhere .= " and r.proveedor_id = $proveedor_id ";
        }

        if($deporte_id != REST_TODOS){
            $sqlWhere .= " and c.deporte_id = $deporte_id ";
        }

        if($reserva_tipo != REST_TODOS){
            $sqlWhere .= " and r.reserva_tipo = $reserva_tipo ";
        }

        if($porFechaReserva == NO){

            $sqlWhere .= Utility::sqlFechaRegistroReserva($fechainicio, $fechafin);
        }else{
            $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);
        }

        $sql = "select coalesce(sum(reserva_comision),0) as total                
                FROM reserva r  
                inner join cancha c on c.cancha_id = r.cancha_id 
                where r.reserva_estado != ".CANCELADO." and r.reserva_estado != ".PENDIENTE_CONFIRMAR_PAGO."
                ".$sqlWhere."  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return Utility::formatearNumero($row);
        } else {
            return Utility::formatearNumero(0);
        }
    }

    public static function totalPagoIngresosByFechaTipoPago($fechainicio, $fechafin, $tipopago = REST_TODOS,
                                                            $proveedor_id = REST_TODOS, $deporte_id = REST_TODOS,
                                                            $reserva_tipo = REST_TODOS, $sinPendienteAprobar = REST_TODOS, $fechaReserva = NO){
        global $pdo;



        $sqlWhere = "";

        if($fechaReserva == SI){

            $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);

        }else{

            $sqlWhere .= Utility::sqlFechaPagoReserva($fechainicio, $fechafin);
        }

        if($tipopago != REST_TODOS){
            $sqlWhere .= " and reservapago_tipo = '$tipopago' ";
        }

        if($proveedor_id != REST_TODOS){
            $sqlWhere .= " and r.proveedor_id = $proveedor_id ";
        }

        if($deporte_id != REST_TODOS){
            $sqlWhere .= " and c.deporte_id = $deporte_id ";
        }

        if($reserva_tipo != REST_TODOS){
            $sqlWhere .= " and r.reserva_tipo = $reserva_tipo ";
        }

        if($sinPendienteAprobar != REST_TODOS){
            $sqlWhere .= " and r.reserva_estado != ".PENDIENTE_CONFIRMAR_PAGO;
        }


        $sql = "select coalesce(sum(reservapago_monto),0) as total
                FROM reservapago rp
                inner join reserva r on r.reserva_id = rp.reserva_id
                inner join cancha c on c.cancha_id = r.cancha_id 
                where r.reserva_estado != ".CANCELADO."
                ".$sqlWhere."  ";

        //exit($sql);
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return ($row);
        } else {
            return (0);
        }
    }

    public static function reporteIngresosEgresos($fechainicio, $fechafin, $pagina = 0, $registros = 0, $estado = PARAM_TODOS)
    {
        global $pdo;
        $reserva_vector = array();
        $sqlWhere = "";
        $start = (int)(($pagina - 1) * $registros);
        $limit = (int)$registros;

        $sqlLimit = "";
        if ($limit != 0 && $limit != -1) {
            $sqlLimit = " LIMIT :start, :limit ";
        }
        $sqlWhere .= Utility::sqlFechaPagoReserva($fechainicio, $fechafin);

        if($estado != PARAM_TODOS){
            $sqlWhere .= " and r.reserva_estado= '".$estado."' ";
        }

        $sqlOrden = " order by r.reserva_id desc ";

        $sql = "SELECT SQL_CALC_FOUND_ROWS r.*, p.proveedor_nombre, c.cancha_nombre, coalesce(sum(reservapago_monto),0) as totalPagado,
                cl.cliente_nombres, cl.cliente_apellidos
                FROM reservapago rp
                inner join reserva r on r.reserva_id = rp.reserva_id
                inner join cancha c on r.cancha_id = c.cancha_id
                inner join proveedor p on p.proveedor_id = c.proveedor_id
                inner join cliente cl on cl.cliente_id = r.cliente_id 
                where 1=1   
                " . $sqlWhere . " 
                group by r.reserva_id
                " . $sqlOrden . " 
                " . $sqlLimit;
        $stmt = $pdo->prepare($sql);

        if ($limit != 0 && $limit != -1) {
            $stmt->bindValue(':start', $start, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        }
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $result = $pdo->query("SELECT FOUND_ROWS() AS totalCount");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        while ($reserva = $stmt->fetch()) {
            $reserva->reserva_tipopagotext = Utility::getDescripcionTipoPagoTxt($reserva->reserva_tipopago);
            $reserva->reserva_estadotext = Utility::getEstadoReservaTxt($reserva->reserva_estado);
            $reserva->pagos =  Reservapago::getByFields(array(
                array("field"=>"reserva_id", "value"=>$reserva->reserva_id, "operator"=>"=")
            ))["reservapago_array"];

            foreach ($reserva->pagos as $pago){

                $pago->reservapago_tipotext =  Utility::getDescripcionTipoPagoTxt($pago->reservapago_tipo);

            }

            $reserva_vector[] = $reserva;
        }
        return array("reserva_array" => $reserva_vector, "totalCount" => $row["totalCount"]);
    }

    public static function getHorarioMasPedido($fechainicio, $fechafin){
        global $pdo;



        $sqlWhere = "";


        $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);



        $sql = "select reserva_horainicio, count(*) as totalReservas
                FROM reserva r 
                where r.reserva_estado != ".CANCELADO."
                ".$sqlWhere."  
                group by reserva_horainicio
                order by totalReservas desc
                limit 1";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return $row;
        } else {
            return null;
        }
    }

    public static function getHorarioMenosPedido($fechainicio, $fechafin){
        global $pdo;



        $sqlWhere = "";


        $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);



        $sql = "select reserva_horainicio, count(*) as totalReservas
                FROM reserva r 
                where r.reserva_estado != ".CANCELADO."
                ".$sqlWhere."  
                group by reserva_horainicio
                order by totalReservas asc
                limit 1";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return $row;
        } else {
            return null;
        }
    }

    public static function reporteCancha($fechainicio, $fechafin, $pagina = 0, $registros = 0)
    {
        global $pdo;
        $reserva_vector = array();
        $sqlWhere = "";
        $start = (int)(($pagina - 1) * $registros);
        $limit = (int)$registros;

        $sqlLimit = "";
        if ($limit != 0 && $limit != -1) {
            $sqlLimit = " LIMIT :start, :limit ";
        }
        $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);

        $sqlOrden = " order by r.reserva_id desc ";

        $sql = "SELECT SQL_CALC_FOUND_ROWS r.*, p.proveedor_nombre, c.cancha_nombre,
                cl.cliente_nombres, cl.cliente_apellidos, d.deporte_nombre
                FROM reserva r
                inner join cancha c on r.cancha_id = c.cancha_id
                inner join proveedor p on p.proveedor_id = c.proveedor_id
                inner join cliente cl on cl.cliente_id = r.cliente_id 
                inner join deporte d on d.deporte_id = c.deporte_id 
                where 1=1   
                " . $sqlWhere . " 
                group by r.reserva_id
                " . $sqlOrden . " 
                " . $sqlLimit;
        $stmt = $pdo->prepare($sql);

        if ($limit != 0 && $limit != -1) {
            $stmt->bindValue(':start', $start, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        }
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $result = $pdo->query("SELECT FOUND_ROWS() AS totalCount");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        while ($reserva = $stmt->fetch()) {
            $reserva->reserva_tipopagotext = Utility::getDescripcionTipoPagoTxt($reserva->reserva_tipopago);
            $reserva->horas_reservadas = Utility::obtenerHorasTranscurridas($reserva->reserva_fechaprogramacion. " " . $reserva->reserva_horainicio, $reserva->reserva_fechaprogramacion. " " . $reserva->reserva_horafin);
            $reserva_vector[] = $reserva;
        }
        return array("reserva_array" => $reserva_vector, "totalCount" => $row["totalCount"]);
    }

    public static function getProveedorReservaByFecha($fechainicio, $fechafin){

        global $pdo;

        $sqlWhere = "";
        $_vector = array();

        $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);


        $sql = "select p.proveedor_nombre, count(*) as cantidadReservas
                from reserva r 
                inner join proveedor p on r.proveedor_id = p.proveedor_id
                where r.reserva_estado != ".CANCELADO."
                ".$sqlWhere."
                 group by r.proveedor_id
                 order by cantidadReservas desc";

        $stmt = $pdo->prepare($sql);

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        while ($obj = $stmt->fetch()) {
            $_vector[] = $obj;
        }
        return $_vector;
    }

    public static function totalUsuariosActivosReserva($fechainicio, $fechafin, $proveedor_id = REST_TODOS, $deporte_id = REST_TODOS){
        global $pdo;

        $sqlWhere = "";


        $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);

        if($proveedor_id != REST_TODOS){
            $sqlWhere .= " and r.proveedor_id = $proveedor_id ";
        }
        if($deporte_id != REST_TODOS){
            $sqlWhere .= " and c.deporte_id = $deporte_id ";
        }


        $sql = "select count(DISTINCT r.cliente_id) as total
                FROM reserva r 
                inner join cliente cl on r.cliente_id = cl.cliente_id
                inner join cancha c on r.cancha_id = c.cancha_id
                where r.reserva_estado != ".CANCELADO." and cl.cliente_estado = ".ACTIVO."
                ".$sqlWhere."  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    }

    public static function getReservasConfirmadasByProveedor($fechainicio,$fechafin, $proveedor_id = REST_TODOS, $deporte_id = REST_TODOS){
        global $pdo;

        $data_vector = array();
        $sqlWhere = "";


        $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);

        if($proveedor_id != REST_TODOS){
            $sqlWhere .= " and r.proveedor_id = $proveedor_id ";
        }
        if($deporte_id != REST_TODOS){
            $sqlWhere .= " and c.deporte_id = $deporte_id ";
        }

        $sql = "select r.*
                FROM reserva r
                inner join cancha c on c.cancha_id = r.cancha_id
                where r.reserva_estado = ".APROBADA." 
                ".$sqlWhere." 
                order by reserva_fechaprogramacion asc 
                ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);

        while ($data = $stmt->fetch()) {
            if(Utility::valorEstaVacio($data->cliente_id)){
                $data->cliente_nombres = $data->reserva_cliente;
                $data->cliente_apellidos = "";
                $data->cliente_telefono = $data->reserva_telefono;
            }else{
                $cliente = Cliente::getById($data->cliente_id);
                $data->cliente_nombres = $cliente->cliente_nombres;
                $data->cliente_apellidos = $cliente->cliente_apellidos;
                $data->cliente_telefono = $cliente->cliente_telefono;
            }

            $data_vector[] = $data;
        }

        return $data_vector;
    }

    public static function getCalendario($proveedor_id, $deporte_id = REST_TODOS){
        $objCalendario = new stdClass();
        $array_diasfecha = array();
        $fechaInicio = Utility::getFechaHoraActual();
        $fechaFin = Utility::addTimeToDate($fechaInicio, "1 month");
        $fechaFinCalendario = Utility::addTimeToDate($fechaInicio, "6 day");

        $array_diassemana = Utility::getDiasSemanaByFechas($fechaInicio, $fechaFinCalendario);

        $array_fechas = Utility::getRangoFechas($fechaInicio, $fechaFin);

        foreach ($array_fechas as $fecha){
            $objFecha = new stdClass();
            $objFecha->fecha = $fecha->fecha_value;
            $objFecha->fecha_text = Utility::getFechaSegunFormato($fecha->fecha_value, "d") . " " . Utility::getNombreMesCorto($fecha->fecha_value);
            $objFecha->total_reservas = Reserva::cantidadTotaReservasByFecha($fecha->fecha_value . " " . HORA_INICIO_FECHA, $fecha->fecha_value . " " . HORA_FIN_FECHA, $proveedor_id, $deporte_id);
            $array_diasfecha[] = $objFecha;
        }


        $objCalendario->diaSemanaList = $array_diassemana;
        $objCalendario->diaList = $array_diasfecha;

        return $objCalendario;

    }

    public static function getEstados(){

        $array_estados = array();

        $array_estados[] = (object)array("estado_id"=>APROBADA,"estado_nombre" => Utility::getEstadoReservaTxt(APROBADA));
        $array_estados[] = (object)array("estado_id"=>FINALIZADA,"estado_nombre" => Utility::getEstadoReservaTxt(FINALIZADA));
        $array_estados[] = (object)array("estado_id"=>CANCELADO,"estado_nombre" => Utility::getEstadoReservaTxt(CANCELADO));

        return $array_estados;
    }

    public static function reservaListProveedorPaginado($proveedor_id, $pagina = 0, $registros = 0,$obj = null)
    {
        global $pdo;
        $reserva_vector = array();
        $sqlWhere = "";
        $start = (int)(($pagina - 1) * $registros);
        $limit = (int)$registros;

        $sqlLimit = "";
        if ($limit != 0 && $limit != -1) {
            $sqlLimit = " LIMIT :start, :limit ";
        }
        if(isset($obj->estado) && $obj->estado != REST_TODOS){
            $sqlWhere.= " and r.reserva_estado = '$obj->estado' ";
        }
        if(isset($obj->deporte) && $obj->deporte != REST_TODOS){
            $sqlWhere.= " and c.deporte_id = '$obj->deporte' ";
        }
        if(isset($obj->size) && $obj->size != REST_TODOS){
            $sqlWhere.= " and c.cancha_size = '$obj->size' ";
        }
        if(isset($obj->fechainicio) && $obj->fechainicio != REST_TODOS && isset($obj->fechafin) && $obj->fechafin != REST_TODOS){
            $sqlWhere .= Utility::sqlFechaProgramacion($obj->fechainicio, $obj->fechafin);
        }
        if(isset($obj->busqueda) && $obj->busqueda != REST_TODOS){
            $sqlWhere .= " and ( cl.cliente_nombres like :busqueda or cl.cliente_apellidos like :busqueda 
            or cl.cliente_telefono like :busqueda or r.reserva_id = '".$obj->busqueda."' or cliente_correo like :busqueda
            or r.reserva_cliente like :busqueda or r.reserva_telefono like :busqueda)";
        }


        $sqlOrden = " order by r.reserva_id desc ";

        $sql = "SELECT SQL_CALC_FOUND_ROWS r.*, cl.cliente_nombres, cl.cliente_apellidos, cl.cliente_telefono, d.deporte_nombre, c.cancha_size, c.cancha_nombre
                from reserva r
                inner join cancha c on c.cancha_id = r.cancha_id
                inner join deporte d on d.deporte_id = c.deporte_id
                left join cliente cl on cl.cliente_id = r.cliente_id
                where r.reserva_estado != ".PENDIENTE_CONFIRMAR_PAGO." and r.proveedor_id = $proveedor_id   " . $sqlWhere . " " . $sqlOrden . " " . $sqlLimit;
        $stmt = $pdo->prepare($sql);

        //exit($sql);

        if(isset($obj->busqueda) && $obj->busqueda != REST_TODOS){
            $stmt->bindValue(':busqueda', "%".$obj->busqueda."%", PDO::PARAM_STR);
        }

        if ($limit != 0 && $limit != -1) {
            $stmt->bindValue(':start', $start, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        }
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $result = $pdo->query("SELECT FOUND_ROWS() AS totalCount");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        while ($reserva = $stmt->fetch()) {
            $reserva_vector[] = $reserva;
        }
        return array("reserva_array" => $reserva_vector, "totalCount" => $row["totalCount"]);
    }

    public static function getTokenNiubiz(){
        $handler = curl_init();
        $url = ENDPOINT_NIUBIZ . "/api.security/v1/security";


        curl_setopt($handler, CURLOPT_URL, $url);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($handler, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($handler, CURLOPT_TIMEOUT, 3);
        curl_setopt($handler, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($handler, CURLOPT_DNS_CACHE_TIMEOUT, 3);
        curl_setopt($handler, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Authorization:' . Utility::encodeBase64(USERNAME_NIUBIZ . ":" . PASSWORD_NIUBIZ)
            )
        );


        $response = curl_exec($handler);
        curl_close($handler);
        return $response;

    }

    public static function getSessionNiubiz($token, $channel, $amount){
        $handler = curl_init();
        $url = ENDPOINT_NIUBIZ . "/api.ecommerce/v2/ecommerce/token/session/" . MERCHANTID_NIUBIZ;

        $objJSON = new stdClass();
        $objJSON->channel = $channel;
        $objJSON->amount = $amount;
        $objEnvioJSON = json_encode($objJSON);

        curl_setopt($handler, CURLOPT_URL, $url);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, $objEnvioJSON);
        curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($handler, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($handler, CURLOPT_TIMEOUT, 3);
        curl_setopt($handler, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($handler, CURLOPT_DNS_CACHE_TIMEOUT, 3);
        curl_setopt($handler, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Authorization:' . $token,
                'Content-Length: ' . strlen($objEnvioJSON),
            )
        );


        $response = curl_exec($handler);
        $response = json_decode($response);
        curl_close($handler);
        return $response;

    }


    public static function crearEcommerceNiubiz($token, $obj){
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = null;

        $handler = curl_init();
        $url = ENDPOINT_NIUBIZ . "/api.authorization/v3/authorization/ecommerce/" . MERCHANTID_NIUBIZ;


        $objEnvioJSON = json_encode($obj);

        curl_setopt($handler, CURLOPT_URL, $url);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handler, CURLOPT_POSTFIELDS, $objEnvioJSON);
        curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($handler, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($handler, CURLOPT_TIMEOUT, 3);
        curl_setopt($handler, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($handler, CURLOPT_DNS_CACHE_TIMEOUT, 3);
        curl_setopt($handler, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Authorization:' . $token,
                'Content-Length: ' . strlen($objEnvioJSON),
            )
        );


        $response = curl_exec($handler);
        $response = json_decode($response);
        curl_close($handler);

        if(isset($response->dataMap)){
            $datos = $response;
            $mensajes[] = $response->dataMap->ACTION_DESCRIPTION;
        }elseif (isset($response->errorCode)){
            if($response->errorCode == 400){
                $mensajes[] = "Error, la autorización ha sido denegada.";
            }elseif($response->errorCode == 401){
                $mensajes[] = "Error, las credenciales utilizadas no son válidas.";
            }elseif($response->errorCode == 406){
                $mensajes[] = "Error, se está enviando de forma duplicada una misma petición de autorización.";
            }elseif($response->errorCode == 500){
                $mensajes[] = "Error al generar la transacción con la pasarela de pago, comunícate con el soporte de GoCancha para mas información.";
            }else{
                $mensajes[] = "Error transacción denegada";
            }

            $tipo = ERROR;
            $datos = $response;
        }else{
            $tipo = ERROR;
            $mensajes[] = "Error transacción denegada";
            $datos = $response;
        }


        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;

        return $data;

    }


    public static function cantidadTotaReservasTipoByFecha($fechainicio, $fechafin, $tiporeserva, $proveedor_id = REST_TODOS, $deporte_id = REST_TODOS){
        global $pdo;



        $sqlWhere = "";


        $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);

        if($proveedor_id != REST_TODOS){
            $sqlWhere .= " and r.proveedor_id = $proveedor_id ";
        }
        if($deporte_id != REST_TODOS){
            $sqlWhere .= " and c.deporte_id = $deporte_id ";
        }



        $sql = "select count(*) as total
                FROM reserva r
                inner join cancha c on c.cancha_id = r.cancha_id 
                where r.reserva_estado != ".CANCELADO." and reserva_tipo = '$tiporeserva'
                ".$sqlWhere."  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return $row * 1;
        } else {
            return 0;
        }
    }

    public static function cantidadTotaReservasCanalByFecha($fechainicio, $fechafin, $canal, $proveedor_id = REST_TODOS, $deporte_id = REST_TODOS){
        global $pdo;



        $sqlWhere = "";


        $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);

        if($proveedor_id != REST_TODOS){
            $sqlWhere .= " and r.proveedor_id = $proveedor_id ";
        }
        if($deporte_id != REST_TODOS){
            $sqlWhere .= " and c.deporte_id = $deporte_id ";
        }



        $sql = "select count(*) as total
                FROM reserva r
                inner join cancha c on c.cancha_id = r.cancha_id 
                where r.reserva_estado != ".CANCELADO." and reserva_canal = '$canal'
                ".$sqlWhere."  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return $row * 1;
        } else {
            return 0;
        }
    }

    public static function getGraficoTotalReservaTipo($fechaInicio, $fechaFin, $proveedor_id, $deporte_id = REST_TODOS){
        $array_grafico = array();
        $array_grafico[] = array("Tipo Reserva", "Total");
        $array_grafico[] = array("APP", Reserva::cantidadTotaReservasTipoByFecha($fechaInicio, $fechaFin, TIPO_RESERVA_APP, $proveedor_id, $deporte_id));
        $array_grafico[] = array("MANUAL", Reserva::cantidadTotaReservasTipoByFecha($fechaInicio, $fechaFin, TIPO_RESERVA_MANUAL, $proveedor_id, $deporte_id));

        return $array_grafico;
    }

    public static function getGraficoTotalReservaCanal($fechaInicio, $fechaFin, $proveedor_id, $deporte_id = REST_TODOS){
        $array_grafico = array();
        $array_grafico[] = array("Canal", "Total");

        $array_canal = Utility::getCanalesReserva();
        foreach ($array_canal as $canal){
            $array_grafico[] = array($canal->canal_nombre, Reserva::cantidadTotaReservasCanalByFecha($fechaInicio, $fechaFin, $canal->canal_id, $proveedor_id, $deporte_id));
        }

        return $array_grafico;
    }

    public static function getUltimasReservasCliente($cliente_id, $limit = 20){
        global $pdo;

        $data_vector = array();
        $sqlWhere = "";
        $sqlWhere .= " and cliente_id = $cliente_id ";

        $sql = "select r.*
                FROM reserva r
                where r.reserva_estado not in (".CANCELADO.",".FINALIZADA.") 
                ".$sqlWhere." 
                order by reserva_fechaprogramacion asc 
                limit $limit
                ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Reserva");

        while ($data = $stmt->fetch()) {
            $data_vector[] = $data;
        }

        return $data_vector;
    }

    public static function getFechaUltimaReservaByCliente($cliente_id, $obj){
        global $pdo;



        $sqlWhere = "";


        if(isset($obj->fechainicio) && $obj->fechainicio != REST_TODOS && isset($obj->fechafin) && $obj->fechafin != REST_TODOS){
            $sqlWhere .= Utility::sqlFechaProgramacion($obj->fechainicio, $obj->fechafin);
        }else{
            return null;
        }

        $sqlWhere .= " and cliente_id = $cliente_id";



        $sql = "select reserva_fechaprogramacion
                FROM reserva r 
                where reserva_id = (select max(reserva_id) from reserva where reserva_estado != ".CANCELADO." ".$sqlWhere.")
                  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return $row;
        } else {
            return null;
        }
    }

    public static function getCantidadReservaByCliente($cliente_id, $obj){
        global $pdo;



        $sqlWhere = "";


        if(isset($obj->fechainicio) && $obj->fechainicio != REST_TODOS && isset($obj->fechafin) && $obj->fechafin != REST_TODOS){
            $sqlWhere .= Utility::sqlFechaProgramacion($obj->fechainicio, $obj->fechafin);
        }else{
            return 0;
        }

        $sqlWhere .= " and r.cliente_id = $cliente_id";



        $sql = "select count(*)
                FROM reserva r 
                where reserva_estado != ".CANCELADO." ".$sqlWhere."
                  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    }

    public static function getMontoTotalReservaByCliente($cliente_id, $obj){
        global $pdo;



        $sqlWhere = "";


        if(isset($obj->fechainicio) && $obj->fechainicio != REST_TODOS && isset($obj->fechafin) && $obj->fechafin != REST_TODOS){
            $sqlWhere .= Utility::sqlFechaProgramacion($obj->fechainicio, $obj->fechafin);
        }else{
            return 0;
        }

        $sqlWhere .= " and r.cliente_id = $cliente_id";



        $sql = "select sum(r.reserva_total)
                FROM reserva r 
                where reserva_estado != ".CANCELADO." ".$sqlWhere."
                  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return round($row,2);
        } else {
            return 0;
        }
    }

    public static function getTopHorarioReservaByCliente($cliente_id, $obj){
        global $pdo;



        $sqlWhere = "";


        if(isset($obj->fechainicio) && $obj->fechainicio != REST_TODOS && isset($obj->fechafin) && $obj->fechafin != REST_TODOS){
            $sqlWhere .= Utility::sqlFechaProgramacion($obj->fechainicio, $obj->fechafin);
        }else{
            return null;
        }

        $sqlWhere .= " and r.cliente_id = $cliente_id";


        $sql = "select reserva_horainicio, count(*) as totalReservas
                FROM reserva r 
                where r.reserva_estado != ".CANCELADO."
                ".$sqlWhere."  
                group by reserva_horainicio
                order by totalReservas desc
                limit 1";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return $row;
        } else {
            return null;
        }
    }

    public static function getTopSizeReservaByCliente($cliente_id, $obj){
        global $pdo;



        $sqlWhere = "";


        if(isset($obj->fechainicio) && $obj->fechainicio != REST_TODOS && isset($obj->fechafin) && $obj->fechafin != REST_TODOS){
            $sqlWhere .= Utility::sqlFechaProgramacion($obj->fechainicio, $obj->fechafin);
        }else{
            return null;
        }

        $sqlWhere .= " and r.cliente_id = $cliente_id";


        $sql = "select cancha_size, count(*) as totalReservas
                FROM reserva r
                inner join cancha c on c.cancha_id = r.cancha_id
                where r.reserva_estado != ".CANCELADO."
                ".$sqlWhere."  
                group by cancha_size
                order by totalReservas desc
                limit 1";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return Cancha::getSizeText($row);
        } else {
            return null;
        }
    }

    public function devolverPagoEnLineaNiubiz(){
        $pagoReserva = Pagodata::getDataPagoIntegracionReserva($this->reserva_id, TIPO_INTEGRACION_PAGO_NIUBIZ);
        if($pagoReserva){

            $token = Reserva::getTokenNiubiz();
            $token = (string) $token;

            $jsonOperacion = json_decode($pagoReserva->pagodata_json);

            if($jsonOperacion) {
                $signature = $jsonOperacion->dataMap->SIGNATURE;

                $params = new stdClass();
                $params->annulationReason = "Se cancelo la reserva y por ende se debe devolver el dinero";
                $body = json_encode($params);

                $handler = curl_init();
                $url = ENDPOINT_NIUBIZ . "/api.authorization/v3/void/ecommerce/".MERCHANTID_NIUBIZ."/".$signature." ";

                curl_setopt($handler, CURLOPT_URL, $url);
                curl_setopt($handler, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($handler, CURLOPT_POSTFIELDS, $body);
                curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($handler, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_setopt($handler, CURLOPT_TIMEOUT, 3);
                curl_setopt($handler, CURLOPT_CONNECTTIMEOUT, 3);
                curl_setopt($handler, CURLOPT_DNS_CACHE_TIMEOUT, 3);
                curl_setopt($handler, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Authorization:' . $token,
                        'Content-Length: ' . strlen($body),
                    )
                );


                $response = curl_exec($handler);
                $response = json_decode($response);
                curl_close($handler);

                return $response;


            }

        }
        return null;
    }

    public function dataNotificacionProveedor(){

        $cliente = $this->getCliente();

        $texto = $cliente->cliente_nombres . " " . $cliente->cliente_apellidos . " registro una reserva entre las " . Utility::getFechaSegunFormato($this->reserva_horainicio,"H:i") . " - " . Utility::getFechaSegunFormato($this->reserva_horafin,"H:i");

        $this->enviarNotificacionProveedor("Tienes una nueva reserva!",$texto);
    }

    public function enviarNotificacionProveedor($message, $messageBig){

        $proveedor = $this->getProveedor();

        $data = array(
            "message" => $message,
            "messageBig" => $messageBig,
            "notificationId" => $this->getreserva_id(),
            "requireLogin" => SI,
            "notificationType" => NOTIFICATION_CHANGE_STATE,
            /*"pedido_latitude" => $pedido_lat,
            "pedido_longitude" => $pedido_lon,
            "max_distance" => $radio,*/
        );
        $proveedor->sendNotificacion($data);

    }


    public function actualizarMontoPago(){
        Reservapago::executeQuery("UPDATE reservapago set reservapago_monto = ? where reserva_id = ? limit 1", array($this->reserva_pagocon, $this->reserva_id));
    }


    public static function getReservasProximaFecha($fecha){
        global $pdo;

        $data_vector = array();

        $fecha = Utility::getFechaSegunFormato($fecha, "Y-m-d H:i:00");

        $sqlWhere = "";
        $sqlWhere .= " and COALESCE(TIMESTAMPDIFF(MINUTE, :fechaactual, CONCAT(reserva_fechaprogramacion, ' ', reserva_horainicio)), 0) = " . (MINUTOS_NOTIFICACION);

        $sql = "select r.*
                FROM reserva r
                where r.reserva_estado = ".APROBADA." and r.reserva_tipo = ".TIPO_RESERVA_APP."
                ".$sqlWhere." 
               
                ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':fechaactual', $fecha, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Reserva");

        while ($data = $stmt->fetch()) {
            $data_vector[] = $data;
        }

        return $data_vector;
    }


    public static function reporteIngresosProveedor($proveedor_id, $fechainicio, $fechafin)
    {
        global $pdo;
        $reserva_vector = array();
        $sqlWhere = "";

        $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);

        $sql = "SELECT SQL_CALC_FOUND_ROWS *
                FROM reserva r
                inner join cancha c on r.cancha_id = c.cancha_id
                inner join deporte d on d.deporte_id = c.deporte_id
                where r.proveedor_id = $proveedor_id and r.reserva_estado != ".CANCELADO." and r.reserva_estado != ".PENDIENTE_CONFIRMAR_PAGO."
                " . $sqlWhere . " order by reserva_fecha asc"
                ;
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);

        while ($reserva = $stmt->fetch()) {

            $reserva->monto_comisionpagoenlinea = 0;
            $reserva->monto_totalrecibir = 0;
            $reserva->monto_app = 0;
            $reserva->monto_cancha = 0;
            $reserva->reserva_tipopagotext = "-";
            $reserva->reserva_tipopagotext_cancha = "-";
            $reserva->monto_adelanto_cancha = 0;

            $array_pagos = Reservapago::getByFields(array(
                array("field"=>"reserva_id", "value"=>$reserva->reserva_id, "operator"=>"=")
            ))["reservapago_array"];


            $tieneComisionEnLinea = false;

            $esPrimera = true;

            foreach ($array_pagos as $pago){

                if($reserva->reserva_tipo == TIPO_RESERVA_APP){

                    if($pago->reservapago_tipo == PAGO_DEPOSITO || $pago->reservapago_tipo == PAGO_ENLINEA){

                        $reserva->monto_app = $reserva->monto_app + $pago->reservapago_monto;
                        $reserva->reserva_tipopagotext = Utility::getDescripcionTipoPagoTxt($pago->reservapago_tipo);

                        if($pago->reservapago_tipo == PAGO_ENLINEA){
                            $tieneComisionEnLinea = true;
                        }

                    }else{

                        $reserva->reserva_tipopagotext_cancha = Utility::getDescripcionTipoPagoTxt($pago->reservapago_tipo);
                        $reserva->monto_cancha = $reserva->monto_cancha + $pago->reservapago_monto;
                    }

                }else{

                    if($esPrimera){

                        $reserva->monto_adelanto_cancha = $reserva->monto_adelanto_cancha + $pago->reservapago_monto;
                        $reserva->reserva_tipopagotext = Utility::getDescripcionTipoPagoTxt($pago->reservapago_tipo);

                        $esPrimera = false;


                    }else{

                        $reserva->monto_cancha = $reserva->monto_cancha + $pago->reservapago_monto;

                        $reserva->reserva_tipopagotext_cancha = Utility::getDescripcionTipoPagoTxt($pago->reservapago_tipo);
                    }

                }

            }

            if($reserva->reserva_tipo == TIPO_RESERVA_APP){
                $reserva->monto_app = $reserva->monto_app - $reserva->reserva_comision;

                if($tieneComisionEnLinea){
                    $reserva->monto_comisionpagoenlinea = $reserva->monto_app * COMISION_PAGO_EN_LINEA;
                }
            }

            $reserva->monto_totalrecibir = $reserva->monto_app - $reserva->monto_comisionpagoenlinea ;
            $reserva->reserva_estadotext = "Activa";

            if($reserva->reserva_estado == "0"){
                $reserva->reserva_estadotext = "Cancelada";
                $reserva->monto_cancha = 0;
                $reserva->monto_app = 0;
                $reserva->reserva_precio = 0;
            }

            $reserva_vector[] = $reserva;
        }
        return $reserva_vector;
    }

    public static function getCantidadReservaByCanchaProveedor($proveedor_id, $cancha_id, $fechainicio, $fechafin){
        global $pdo;



        $sqlWhere = "";


        if($fechainicio != REST_TODOS && $fechafin != REST_TODOS){
            $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);
        }else{
            return 0;
        }

        $sqlWhere .= " and r.cancha_id = $cancha_id";
        $sqlWhere .= " and r.proveedor_id = $proveedor_id";



        $sql = "select count(*)
                FROM reserva r 
                where reserva_estado != ".CANCELADO." ".$sqlWhere."
                  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    }

    public static function cantidadTotaReservasCanalProveedorByFecha($fechainicio, $fechafin, $canal, $proveedor_id = REST_TODOS){
        global $pdo;



        $sqlWhere = "";


        $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);

        if($proveedor_id != REST_TODOS){
            $sqlWhere .= " and r.proveedor_id = $proveedor_id ";
        }




        $sql = "select count(*) as total
                FROM reserva r
                where r.reserva_estado != ".CANCELADO." and reserva_canal = '$canal'
                ".$sqlWhere."  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return $row * 1;
        } else {
            return 0;
        }
    }

    public static function getTopHorarioReservaProveedor($proveedor_id, $fechainicio, $fechafin, $limit = 5){
        global $pdo;

        $reserva_vector = array();

        $sqlWhere = "";


        if($fechainicio != REST_TODOS && $fechafin != REST_TODOS){
            $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);
        }else{
            return null;
        }

        $sqlWhere .= " and r.proveedor_id = $proveedor_id";


        $sql = "select reserva_horainicio, count(*) as totalReservas
                FROM reserva r 
                where r.reserva_estado != ".CANCELADO."
                ".$sqlWhere."  
                group by reserva_horainicio
                order by totalReservas desc
                limit $limit";

        //exit($sql);
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);

        while ($reserva = $stmt->fetch()) {
            $reserva_vector[] = $reserva;
        }
        return $reserva_vector;
    }

    public static function getTopClienteReservaProveedor($proveedor_id, $fechainicio, $fechafin, $limit = 5){
        global $pdo;

        $reserva_vector = array();

        $sqlWhere = "";


        if($fechainicio != REST_TODOS && $fechafin != REST_TODOS){
            $sqlWhere .= Utility::sqlFechaProgramacion($fechainicio, $fechafin);
        }else{
            return null;
        }

        $sqlWhere .= " and r.proveedor_id = $proveedor_id";


        $sql = "select c.cliente_id, c.cliente_nombres, c.cliente_apellidos, count(*) as totalReservas
                FROM reserva r 
                inner join cliente c on r.cliente_id = c.cliente_id
                where r.reserva_estado != ".CANCELADO."
                ".$sqlWhere."  
                group by r.cliente_id
                order by totalReservas desc
                limit $limit";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);

        while ($reserva = $stmt->fetch()) {
            $reserva_vector[] = $reserva;
        }
        return $reserva_vector;
    }
}
?>