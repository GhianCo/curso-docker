<?php 
class Proveedor extends ProveedorEntity {

    public static function obtenerCanchasCercaPaginado($latitud, $longitud, $deporte_id = PARAM_TODOS, $pagina = 0, $registros  = 0, $busqueda = PARAM_TODOS){

        global $pdo;


        $_vector = array();

        $sqlLimit = "";

        $distance_radius = DISTANCIA_CERCANIA;


        $sqlWhere = "";
        if($pagina != 0){

            $start = (int)(($pagina - 1) * $registros);
            $limit = (int)$registros;

            if ($limit != 0 && $limit != -1) {
                $sqlLimit = " LIMIT :start, :limit ";
            }

        }

        $sqlOrder = " order by distancia asc, p.proveedor_rating desc ";


        $sqlWhere .= " and p.proveedor_estado = 1 and p.proveedor_encendido = 1   ";

        if($busqueda != PARAM_TODOS){

            $sqlWhere .= " and p.proveedor_nombre like :busqueda ";
        }


        if($latitud != PARAM_TODOS && $longitud != PARAM_TODOS){
            $sqlWhere .= " and 
                    (6371 * ACOS(SIN(RADIANS(proveedor_latitud)) * SIN(RADIANS(" . $latitud . ")) 
                                + COS(RADIANS(proveedor_longitud - " . $longitud . ")) * COS(RADIANS(proveedor_latitud)) 
                                * COS(RADIANS(" . $latitud . "))
                                )
                   ) < $distance_radius
            ";
        }

        if($deporte_id != PARAM_TODOS){
            $sqlWhere .= " and (select count(*) from cancha where proveedor_id = p.proveedor_id and cancha_estado = 1 and deporte_id = $deporte_id) > 0 ";
        }


        $sql = "SELECT SQL_CALC_FOUND_ROWS p.proveedor_id, p.proveedor_nombre, p.proveedor_urllogo, p.proveedor_rating, ROUND((6371 * ACOS(SIN(RADIANS(proveedor_latitud)) * SIN(RADIANS(" . $latitud . ")) 
                                + COS(RADIANS(proveedor_longitud - " . $longitud . ")) * COS(RADIANS(proveedor_latitud)) 
                                * COS(RADIANS(" . $latitud . "))
                                )
                   ),2) as distancia
                    from proveedor p   
        where  1=1 " . $sqlWhere . "  ".$sqlOrder . $sqlLimit;
        $stmt = $pdo->prepare($sql);


        if($pagina != 0){

            $stmt->bindValue(':start', $start, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        }

        if($busqueda != PARAM_TODOS){
            $busqueda = '%' . $busqueda . '%';
            $stmt->bindValue(':busqueda', $busqueda, PDO::PARAM_STR);
        }

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $result = $pdo->query("SELECT FOUND_ROWS() AS totalCount");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        while ($obj = $stmt->fetch()) {
            $_vector[] = $obj;
        }
        return array("proveedor_array" => $_vector, "totalCount" => $row["totalCount"]);
    }

    public static function getProveedoresFavoritosPaginado($cliente_id, $deporte_id = PARAM_TODOS, $pagina = 0, $registros  = 0, $busqueda = PARAM_TODOS){

        global $pdo;


        $_vector = array();

        $sqlLimit = "";


        $sqlWhere = "";
        if($pagina != 0){

            $start = (int)(($pagina - 1) * $registros);
            $limit = (int)$registros;

            if ($limit != 0 && $limit != -1) {
                $sqlLimit = " LIMIT :start, :limit ";
            }

        }

        $sqlOrder = " order by p.proveedor_rating desc, f.favorito_fecha desc ";


        $sqlWhere .= " and p.proveedor_estado = 1 and p.proveedor_encendido = 1   ";

        if($busqueda != PARAM_TODOS){

            $sqlWhere .= " and p.proveedor_nombre like :busqueda ";
        }

        if($deporte_id != PARAM_TODOS){
            $sqlWhere .= " and (select count(*) from cancha where proveedor_id = p.proveedor_id and cancha_estado = 1 and deporte_id = $deporte_id) > 0 ";
        }

        $sqlWhere .= " and f.cliente_id = $cliente_id ";




        $sql = "SELECT SQL_CALC_FOUND_ROWS p.proveedor_id, p.proveedor_nombre, p.proveedor_urllogo, p.proveedor_rating
                from favorito f
                inner join proveedor p on p.proveedor_id = f.proveedor_id  
        where  1=1 " . $sqlWhere . "  ".$sqlOrder . $sqlLimit;
        $stmt = $pdo->prepare($sql);


        if($pagina != 0){

            $stmt->bindValue(':start', $start, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        }

        if($busqueda != PARAM_TODOS){
            $busqueda = '%' . $busqueda . '%';
            $stmt->bindValue(':busqueda', $busqueda, PDO::PARAM_STR);
        }

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $result = $pdo->query("SELECT FOUND_ROWS() AS totalCount");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        while ($obj = $stmt->fetch()) {
            $_vector[] = $obj;
        }
        return array("proveedor_array" => $_vector, "totalCount" => $row["totalCount"]);
    }

    public static function listarPorBusqueda($busqueda = '',$limit = 10)
    {
        global $pdo;
        $salida_vector = array();

        if ($busqueda == null || $busqueda == "") return $salida_vector;


        $sql = "SELECT * 
                FROM proveedor op
                WHERE op.proveedor_estado= 1 and (op.proveedor_nombre like :busqueda or op.proveedor_razonsocial like :busqueda or proveedor_ruc like :busqueda)
                LIMIT ".$limit;

        $stmt = $pdo->prepare($sql);
        $busqueda = '%' . $busqueda . '%';
        $stmt->bindParam(':busqueda', $busqueda, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Proveedor');
        $salida = array();

        while ($salida = $stmt->fetch()) {
            $salida_vector[] = $salida;
        }

        return array("salida_array" => $salida_vector);
    }

    public static function listarPorPaginacion($busqueda = PARAM_TODOS, $filtrarByUsuario = SI, $pagina = 0, $registros  = 0){

        global $pdo;


        $_vector = array();

        $sqlLimit = "";


        $sqlWhere = "";
        if($pagina != 0){

            $start = (int)(($pagina - 1) * $registros);
            $limit = (int)$registros;

            if ($limit != 0 && $limit != -1) {
                $sqlLimit = " LIMIT :start, :limit ";
            }

        }

        $sqlOrder = "";


        if($busqueda != PARAM_TODOS){

            $sqlWhere .= " and (p.proveedor_nombre like :busqueda or p.proveedor_razonsocial like :busqueda or p.proveedor_ruc like :busqueda ) ";
        }

        if($filtrarByUsuario == SI){
            $usuario_id = Security::getCurrentUserId();
            $sqlWhere .= " and (select count(*) from usuarioproveedor where usuario_id = $usuario_id and proveedor_id = p.proveedor_id) > 0";
        }



        $sql = "SELECT SQL_CALC_FOUND_ROWS p.*
                from proveedor p
        where  1=1 " . $sqlWhere . "  ".$sqlOrder . $sqlLimit;
        $stmt = $pdo->prepare($sql);


        if($pagina != 0){

            $stmt->bindValue(':start', $start, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        }

        if($busqueda != PARAM_TODOS){
            $busqueda = '%' . $busqueda . '%';
            $stmt->bindValue(':busqueda', $busqueda, PDO::PARAM_STR);
        }

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Proveedor");
        $result = $pdo->query("SELECT FOUND_ROWS() AS totalCount");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        while ($obj = $stmt->fetch()) {
            $_vector[] = $obj;
        }
        return array("proveedor_array" => $_vector, "totalCount" => $row["totalCount"]);
    }

    public function guardarHorario($array_obj)
    {
        foreach ($array_obj as $horarioatenciondia) {
            if (!$horarioatenciondia->horarioatenciondia_id) {
                $had = new Horarioatenciondia(get_object_vars($horarioatenciondia));
                $had->proveedor_id = $this->proveedor_id;
                $resultado = $had->insert();
                $horarioatenciondia->horarioatenciondia_id = $resultado;
                foreach ($horarioatenciondia->horarioatencionList as $horarioatencion) {
                    if (!$horarioatencion->horarioatencion_id && !isset($horarioatencion->estado)) {
                        $ha = new Horarioatencion(get_object_vars($horarioatencion));
                        $ha->setHorarioatenciondia_id($horarioatenciondia->horarioatenciondia_id);
                        $resultado = $ha->insert();
                        if ($resultado) {
                            $horarioatencion->horarioatencion_id = $resultado;
                        }
                    } else {
                        if (isset($horarioatencion->estado) && $horarioatencion->estado == INACTIVO) {
                            $ha = new Horarioatencion(get_object_vars($horarioatencion));
                            $ha->delete();
                        } else {
                            $ha = new Horarioatencion(get_object_vars($horarioatencion));
                            $ha->update();
                        }
                    }
                }
            } else {
                $had = new Horarioatenciondia(get_object_vars($horarioatenciondia));
                $had->update();
                foreach ($horarioatenciondia->horarioatencionList as $horarioatencion) {
                    if (!$horarioatencion->horarioatencion_id && !isset($horarioatencion->estado)) {
                        $ha = new Horarioatencion(get_object_vars($horarioatencion));
                        $ha->setHorarioatenciondia_id($horarioatenciondia->horarioatenciondia_id);
                        $resultado = $ha->insert();
                        if ($resultado) {
                            $horarioatencion->horarioatencion_id = $resultado;
                        }
                    } else {
                        if (isset($horarioatencion->estado) && $horarioatencion->estado == INACTIVO) {
                            $ha = new Horarioatencion(get_object_vars($horarioatencion));
                            $ha->delete();
                        } else {
                            $ha = new Horarioatencion(get_object_vars($horarioatencion));
                            $ha->setHorarioatenciondia_id($horarioatenciondia->horarioatenciondia_id);
                            $ha->update();
                        }
                    }
                }
            }
        }
    }

    public function getHorarioAtencioHoy(){

        $array_horario = array();

        $horarioatenciondia_array = Horarioatenciondia::getHorarioByID($this->proveedor_id);
        foreach ($horarioatenciondia_array as $horario) {
            $array_horario = Utility::getObjetoFormateadoHorario($horario, $array_horario);
        }

        return $array_horario;

    }

    public static function getHorarioTextHoy($proveedor_id){

        $dTime = new DateTime();
        $horaInicio = null;
        $horaFin = null;

        $horarioList = Horarioatenciondia::getHorarioDiaByID($proveedor_id, $dTime->format('N'));

        foreach ($horarioList as $horario){
            foreach ($horario->horaList as $hora){
                if(!$horaInicio){
                    $horaInicio = $hora->horarioatencion_inicio;
                }
                $horaFin = $hora->horarioatencion_fin;
            }
        }

        if($horaInicio && $horaFin){
            $dateInicio = DateTime::createFromFormat('H:i:s', $horaInicio);
            $dateFin = DateTime::createFromFormat('H:i:s', $horaFin);
            return $dateInicio->format("H:i") . " a " . $dateFin->format("H:i");
        }

        return null;

    }

    public function calcularComisionGanada($monto){

        if($this->proveedor_tipocomision == TIPO_COMISION_PORCENTAJE){

            $_valor_comision = $this->proveedor_comision / 100;

            $_montofinal = $monto + $monto * $_valor_comision;

        }elseif($this->proveedor_tipocomision == TIPO_COMISION_MONTO){

            $_montofinal = $monto + ($this->proveedor_comision * 1) ;

        }else{
            $_montofinal = $monto;
        }

        return ceil($_montofinal - $monto);

    }

    public function favoritoClient($client_id)
    {
        global $pdo;

        $sql = "SELECT * from favorito  where cliente_id = ".$client_id."  and proveedor_id = ".$this->getProveedor_id()." limit 1 " ;
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();
        if ($row) {
            return $row["favorito_id"];
        } else {
            return false;
        }
    }

    public function crearFavoritoClient($client_id){
        $objFavorito = new Favorito();
        $objFavorito->setCliente_id($client_id);
        $objFavorito->setProveedor_id($this->getProveedor_id());
        $objFavorito->setFavorito_fecha(Utility::getFechaHoraActual());
        $objFavorito->insert();
    }

    public function calcularRating(){

        $_rating = Reserva::obtenerCalculoRatingProveedor($this->proveedor_id);

        $this->setProveedor_rating($_rating);

        $this->update();

    }

    public function guardarBeneficios($array_caracteristicaInsert){
        $array_caracteristica = Proveedorcaracteristica::obtenerCaracteristicaListByProveedor($this->getProveedor_id());
        foreach ($array_caracteristica as $caracteristica){
            $objCaracteristica = new Proveedorcaracteristica(get_object_vars($caracteristica));
            $objCaracteristica->delete();
        }

        foreach ($array_caracteristicaInsert as $caracteristica){
            $objCaracteristica = new Proveedorcaracteristica(get_object_vars($caracteristica));
            $objCaracteristica->proveedor_id = $this->getProveedor_id();
            $objCaracteristica->insert();
        }
    }

    public static function getTotalByProveedorFiltros($obj = null){
        global $pdo;



        $sqlWhere = "";

        if(isset($obj->deporte_id) && $obj->deporte_id != REST_TODOS){
            $sqlWhere .= " and c.deporte_id = $obj->deporte_id ";
        }

        if(isset($obj->fechainicio) && $obj->fechainicio != REST_TODOS && isset($obj->fechafin) && $obj->fechafin != REST_TODOS){
            $sqlWhere .= " and r.reserva_fecha between '$obj->fechainicio' and '$obj->fechafin' ";
        }


        $sql = "select count(DISTINCT c.proveedor_id) as total
                FROM proveedor p
                inner join cancha c on c.proveedor_id = p.proveedor_id 
                inner join reserva r on c.cancha_id = r.cancha_id
                where c.cancha_estado = ".ACTIVO." and p.proveedor_estado = ".ACTIVO."
                ".$sqlWhere."  
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

    public function getPorcentajeComisionText(){

        if($this->proveedor_tipocomision == TIPO_COMISION_PORCENTAJE){
            return $this->proveedor_comision * 1 . "" . Utility::getTipoComisionText($this->proveedor_tipocomision);
        }elseif($this->proveedor_tipocomision == TIPO_COMISION_MONTO){
            return Utility::getTipoComisionText($this->proveedor_tipocomision). " " . $this->proveedor_comision;
        }

        return "-";
    }

    public static function reporteProveedores($pagina = 0, $registros = 0, $obj = null)
    {
        global $pdo;
        $proveedor_vector = array();
        $sqlWhere = "";
        $start = (int)(($pagina - 1) * $registros);
        $limit = (int)$registros;

        $sqlLimit = "";
        if ($limit != 0 && $limit != -1) {
            $sqlLimit = " LIMIT :start, :limit ";
        }
        $sqlWhere = "";

        if(isset($obj->deporte_id) && $obj->deporte_id != REST_TODOS){
            $sqlWhere .= " and c.deporte_id = $obj->deporte_id ";
        }

        if(isset($obj->fechainicio) && $obj->fechainicio != REST_TODOS && isset($obj->fechafin) && $obj->fechafin != REST_TODOS){
            $sqlWhere .= " and r.reserva_fecha between '$obj->fechainicio' and '$obj->fechafin' ";
        }

        $sqlOrden = " order by proveedor_comision desc ";

        $sql = "SELECT SQL_CALC_FOUND_ROWS p.*, count(*) as total_reservas, 
                sum(r.reserva_comision) as proveedor_comision, 
                sum(COALESCE(TIMESTAMPDIFF(MINUTE, CONCAT(reserva_fechaprogramacion, ' ', reserva_horainicio), CONCAT(reserva_fechaprogramacion, ' ', reserva_horafin)), 0)) as total_horas
                FROM proveedor p
                inner join cancha c on c.proveedor_id = p.proveedor_id 
                inner join reserva r on c.cancha_id = r.cancha_id 
                where c.cancha_estado = ".ACTIVO." and p.proveedor_estado = ".ACTIVO."
                " . $sqlWhere . " 
                group by c.proveedor_id
                " . $sqlOrden . " 
                " . $sqlLimit;
        $stmt = $pdo->prepare($sql);

        if ($limit != 0 && $limit != -1) {
            $stmt->bindValue(':start', $start, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        }
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Proveedor");
        $result = $pdo->query("SELECT FOUND_ROWS() AS totalCount");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        while ($proveedor = $stmt->fetch()) {
            $proveedor->total_horas = round($proveedor->total_horas/60,0);
            $proveedor->total_canchas = Cancha::getTotalCanchasByProveedor($proveedor->proveedor_id);
            $proveedor->proveedor_ultimaconexion = Tokenproveedor::getUltimaFechaOperacion($proveedor->proveedor_id);
            $proveedor_vector[] = $proveedor;
        }
        return array("proveedor_array" => $proveedor_vector, "totalCount" => $row["totalCount"]);
    }

    public static function getClienteListProveedor($obj)
    {
        global $pdo;
        $cliente_vector = array();
        $sqlWhere = "";
        $sqlOrden = "";
        $sqlLimit = "";

        if(isset($obj->fechareserva) && $obj->fechareserva == SI){
            if(isset($obj->fechainicio) && $obj->fechainicio != REST_TODOS && isset($obj->fechafin) && $obj->fechafin != REST_TODOS){
                $sqlWhere .= Utility::sqlFechaRegistroReserva($obj->fechainicio, $obj->fechafin);
            }
        }else{
            if(isset($obj->fechainicio) && $obj->fechainicio != REST_TODOS && isset($obj->fechafin) && $obj->fechafin != REST_TODOS){
                $sqlWhere .= Utility::sqlFechaProgramacion($obj->fechainicio, $obj->fechafin);
            }
        }


        if(isset($obj->tiporeservafiltro) && $obj->tiporeservafiltro != REST_TODOS){
            if($obj->tiporeservafiltro == "1"){// Con Mayor Reserva
                $sqlOrden = " order by totalreservas desc ";
            }elseif ($obj->tiporeservafiltro == "2"){// Con Menor Reserva
                $sqlOrden = " order by totalreservas asc ";
            }
        }

        if(isset($obj->estado) && $obj->estado != REST_TODOS){
            if($obj->estado == ACTIVO){
                $sqlWhere .= " and (select count(*) from clienteproveedor where cliente_id = c.cliente_id and proveedor_id = $obj->proveedor_id) = 0";
            }elseif($obj->estado == INACTIVO){
                $sqlWhere .= " and (select count(*) from clienteproveedor where cliente_id = c.cliente_id and proveedor_id = $obj->proveedor_id) > 0";
            }
        }

        if(isset($obj->busqueda) && $obj->busqueda != REST_TODOS){
            $sqlWhere .= " and ( c.cliente_nombres like :busqueda or c.cliente_apellidos like :busqueda or c.cliente_telefono like :busqueda
                                or c.cliente_id = '".$obj->busqueda."')";
        }

        if (isset($obj->pagina) && $obj->pagina != REST_TODOS && isset($obj->registros) && $obj->registros != REST_TODOS) {
            $sqlLimit = " LIMIT " . ($obj->pagina - 1) * $obj->registros . "," . $obj->registros . " ";
        }

        $sqlWhere .= " and r.proveedor_id = $obj->proveedor_id";




        $sql = "SELECT SQL_CALC_FOUND_ROWS c.cliente_id, c.cliente_nombres, c.cliente_apellidos, c.cliente_telefono, c.cliente_estado, count(*) as totalreservas
                FROM reserva r
                inner join cliente c on c.cliente_id = r.cliente_id 
                where c.cliente_estado = ".ACTIVO." and r.reserva_estado != ".CANCELADO." and r.reserva_estado != ".PENDIENTE_CONFIRMAR_PAGO."
                " . $sqlWhere . " 
                group by r.cliente_id
                " . $sqlOrden . " 
                " . $sqlLimit;
        $stmt = $pdo->prepare($sql);

        //exit($sql);

        if(isset($obj->busqueda) && $obj->busqueda != REST_TODOS){
            $stmt->bindValue(':busqueda', "%".$obj->busqueda."%", PDO::PARAM_STR);
        }

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $result = $pdo->query("SELECT FOUND_ROWS() AS totalCount");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        while ($cliente = $stmt->fetch()) {
            $cliente_vector[] = $cliente;
        }
        return array("cliente_array" => $cliente_vector, "totalCount" => $row["totalCount"]);
    }

    public function sendNotificacion($notificacion, $device_id = null){

        $array_dispositivos_android = Tokenproveedor::obtenerTokenDispositivosAndroid($this->proveedor_id, $device_id);
        $array_dispositivos_ios = Tokenproveedor::obtenerTokenDispositivosiOS($this->proveedor_id, $device_id);

        APS::enviarNotificacion($notificacion, $array_dispositivos_ios, SI);
        FCM::enviarNotificacion($notificacion, $array_dispositivos_android, SI);
    }

    public static function getProveedorListParaBusqueda($busqueda = PARAM_TODOS, $pagina = 0, $registros  = 0){

        global $pdo;


        $_vector = array();


        $sqlWhere = "";
        $sqlLimit = "";

        if($pagina != 0){

            $start = (int)(($pagina - 1) * $registros);
            $limit = (int)$registros;

            if ($limit != 0 && $limit != -1) {
                $sqlLimit = " LIMIT :start, :limit ";
            }

        }

        $sqlWhere .= " and p.proveedor_estado = ".ACTIVO." and p.proveedor_encendido = ".SI."  ";

        if($busqueda != PARAM_TODOS){

            $sqlWhere .= " and (p.proveedor_nombre like :busqueda ) ";

        }


        $sql = "SELECT * 
                from  proveedor p                  
                where  1=1 " . $sqlWhere . " 
                order by proveedor_rating desc " . $sqlLimit;
        $stmt = $pdo->prepare($sql);


        if($pagina != 0){

            $stmt->bindValue(':start', $start, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        }

        if($busqueda != PARAM_TODOS){
            $busqueda = '%' . $busqueda . '%';
            $stmt->bindValue(':busqueda', $busqueda, PDO::PARAM_STR);
        }

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        while ($obj = $stmt->fetch()) {
            $_vector[] = $obj;
        }
        return $_vector;
    }

    public static function agruparReservasBySemana($array_reservas){
        $array_agrupado = array();

        foreach ($array_reservas as $reserva){
            $encontrado = false;
            $semana = Utility::obtenerFechaConFormato($reserva->reserva_fecha, "W");

            foreach ($array_agrupado as $grupo){
                if($grupo->semana == $semana){
                    $encontrado = true;
                    $grupo->total_ingresos += $reserva->reserva_comision * 1;
                    $grupo->fechafinal = Utility::ultimoDiaSemana($reserva->reserva_fecha);
                    break;
                }
            }

            if(!$encontrado){
                $obj = new stdClass();
                $obj->fechainicial = Utility::primerDiaSemana($reserva->reserva_fecha);
                $obj->fechafinal = $reserva->reserva_fecha;
                $obj->semana = Utility::obtenerFechaConFormato($reserva->reserva_fecha, "W");
                $obj->total_ingresos = $reserva->reserva_comision * 1;
                $array_agrupado[] = $obj;
            }
        }

        return $array_agrupado;
    }

    public static function facturacionPorProveedor($proveedor_id, $f1, $f2){

        $array_salida = Facturacion::getFactProveedor($proveedor_id,$f1,$f2);

        foreach ($array_salida as $fac){

            $fac->total_ingresos = $fac->facturacion_totalcomisiones * 1;

            $estado = "Por facturar";

            $fac->urldeposito = "-";
            if($fac->facturacion_estado == FACTURACION_PAGADA){
                $estado = "Facturada";
                $fac->urldeposito = "https://res.cloudinary.com/gocancha/image/upload/c_fit,f_auto,h_263,q_80,w_350/v1/".$fac->facturacion_urldeposito;
            }
            $fac->estado = $estado;

        }

        return $array_salida;
    }



 }
?>