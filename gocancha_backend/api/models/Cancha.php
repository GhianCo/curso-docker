<?php 
class Cancha extends CanchaEntity {

    public static function getCanchaListParaBusqueda($busqueda = PARAM_TODOS, $pagina = 0, $registros  = 0){

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




        $sqlWhere .= " and p.proveedor_estado = ".ACTIVO." and d.deporte_estado = ".ACTIVO." and c.cancha_estado = ".ACTIVO." and p.proveedor_encendido = ".SI."  ";

        if($busqueda != PARAM_TODOS){

            $sqlWhere .= " and (c.cancha_nombre like :busqueda or p.proveedor_nombre like :busqueda or d.deporte_nombre like :busqueda  ) ";

        }


        $sql = "SELECT c.cancha_id, c.cancha_nombre, p.proveedor_nombre, p.proveedor_id, d.deporte_nombre, c.cancha_precio, c.cancha_tipo, c.cancha_size
                from cancha c
                inner join proveedor p on p.proveedor_id = c.proveedor_id 
                inner join deporte d on d.deporte_id = c.deporte_id
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

    public static function getTipos(){

        $array_tipos = array();

        $array_tipos[] = (object)array("tipo_id"=>"1","tipo_nombre" => "Césped natural");
        $array_tipos[] = (object)array("tipo_id"=>"2","tipo_nombre" => "Arena");
        $array_tipos[] = (object)array("tipo_id"=>"3","tipo_nombre" => "Losa");
        $array_tipos[] = (object)array("tipo_id"=>"4","tipo_nombre" => "Greda");
        $array_tipos[] = (object)array("tipo_id"=>"5","tipo_nombre" => "Cemento");
        $array_tipos[] = (object)array("tipo_id"=>"6","tipo_nombre" => "Césped artificial");
        $array_tipos[] = (object)array("tipo_id"=>"7","tipo_nombre" => "Hierba");
        $array_tipos[] = (object)array("tipo_id"=>"8","tipo_nombre" => "Tierra Batida");

        return $array_tipos;
    }

    public static function getTipoText($tipo_id){
        $array_tipos = Cancha::getTipos();

        foreach ($array_tipos as $tipo){
            if($tipo->tipo_id == $tipo_id){
                return $tipo->tipo_nombre;
            }
        }

        return null;

    }

    public static function getSizes(){

        $array_sizes = array();

        //$array_sizes[] = (object)array("size_id"=>"1","size_nombre" => "3 vs 3");
        //$array_sizes[] = (object)array("size_id"=>"2","size_nombre" => "4 vs 4");
        //$array_sizes[] = (object)array("size_id"=>"3","size_nombre" => "5 vs 5");
        $array_sizes[] = (object)array("size_id"=>"4","size_nombre" => "6 vs 6");
        $array_sizes[] = (object)array("size_id"=>"5","size_nombre" => "7 vs 7");
        //$array_sizes[] = (object)array("size_id"=>"6","size_nombre" => "8 vs 8");
        //$array_sizes[] = (object)array("size_id"=>"7","size_nombre" => "9 vs 9");
        //$array_sizes[] = (object)array("size_id"=>"8","size_nombre" => "10 vs 10");
        $array_sizes[] = (object)array("size_id"=>"9","size_nombre" => "11 vs 11");

        return $array_sizes;
    }

    public static function getSizeText($size_id){
        $array_sizes = Cancha::getSizes();

        foreach ($array_sizes as $size){
            if($size->size_id == $size_id){
                return $size->size_nombre;
            }
        }

        return null;

    }

    public function agregarImagenes($array_imagen){
        foreach ($array_imagen as $imagen){
            $objCanchaImagen = new Canchaimagen(get_object_vars($imagen));
            $objCanchaImagen->cancha_id = $this->cancha_id;

            if($objCanchaImagen->canchaimagen_id > 0 && isset($imagen->porEliminar) && $imagen->porEliminar == SI){
                $objCanchaImagen->delete();
            }elseif($objCanchaImagen->canchaimagen_id > 0){
                $objCanchaImagen->update();
            }else{
                $objCanchaImagen->insert();
            }


        }
    }


    public function guardarHorario($array_obj)
    {
        foreach ($array_obj as $horarioatenciondia) {
            if (!$horarioatenciondia->horarioatenciondia_id) {
                $had = new Horarioatenciondia(get_object_vars($horarioatenciondia));
                $had->cancha_id = $this->cancha_id;
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

        $horarioatenciondia_array = Horarioatenciondia::getHorarioByID($this->cancha_id);
        foreach ($horarioatenciondia_array as $horario) {
            $array_horario = Utility::getObjetoFormateadoHorario($horario, $array_horario);
        }

        return $array_horario;

    }


    public function getImagenes(){
        $array_salida = Canchaimagen::getByFields(array(
            array('field'=>'cancha_id','value'=>$this->cancha_id,'operator'=>'=')
        ));
        return $array_salida['canchaimagen_array'];
    }


    public static function getListaPaginacionByFiltros($pagina = 0, $registros  = 0, $obj = null){

        global $pdo;


        $_vector = array();

        $sqlLimit = "";

        $distance_radius = DISTANCIA_CERCANIA;
        $latitud = 0;
        $longitud = 0;

        if(isset($obj->latitud)) $latitud = $obj->latitud;
        if(isset($obj->longitud)) $longitud = $obj->longitud;
        if(isset($obj->distancia)) $distance_radius = $obj->distancia;


        $sqlWhere = "";
        $sqlSelect = "";
        if($pagina != 0){

            $start = (int)(($pagina - 1) * $registros);
            $limit = (int)$registros;

            if ($limit != 0 && $limit != -1) {
                $sqlLimit = " LIMIT :start, :limit ";
            }

        }

        $sqlOrder = " order by p.proveedor_rating desc, distancia desc ";


        if(isset($obj->deporte_id) && $obj->deporte_id != PARAM_TODOS){
            $sqlWhere .= " and c.deporte_id = $obj->deporte_id  ";
        }

        if(isset($obj->tipo_id) && $obj->tipo_id != PARAM_TODOS){
            $sqlWhere .= " and c.cancha_tipo = $obj->tipo_id  ";
        }


        if(isset($obj->caracteristicaList) && is_array($obj->caracteristicaList) && sizeof($obj->caracteristicaList)){

            $stringCaracteristica = implode(",", $obj->caracteristicaList);
            $sqlWhere .= " and (select count(*) from proveedorcaracteristica where proveedor_id = p.proveedor_id and caracteristica_id in ($stringCaracteristica) ) > 0";

        }else if(isset($obj->caracteristica_id) && $obj->caracteristica_id != PARAM_TODOS){

            /**
             * Le agrego esto en caso solo me envien un caracteristica_id
             */
            $sqlWhere .= " and (select count(*) from proveedorcaracteristica where proveedor_id = p.proveedor_id and caracteristica_id in ($obj->caracteristica_id) ) > 0";

        }

        if(isset($obj->size_id) && $obj->size_id != PARAM_TODOS){
            $sqlWhere .= " and c.cancha_size = $obj->size_id  ";
        }

        if(isset($obj->proveedor_id) && $obj->proveedor_id != PARAM_TODOS){
            $sqlWhere .= " and c.proveedor_id = $obj->proveedor_id  ";
        }

        if(isset($obj->favorito) && $obj->favorito == SI){
            $cliente_id = Security::getCurrentClienteId();
            $sqlWhere .= " and (select count(*) from favorito where proveedor_id = p.proveedor_id and cliente_id = $cliente_id) > 0 ";
        }

        if(isset($obj->fecha) && $obj->fecha != PARAM_TODOS){
            $diaSemana = Utility::getDiaSemanaByFecha($obj->fecha);
            if(isset($obj->horainicio) && isset($obj->horafin)){

                $horaInicio = Utility::formatearHoraSinSegundos($obj->horainicio);
                $fecha = Utility::getFechaCortaFormateadaBD($obj->fecha);
                $horaFin = Utility::formatearHoraSinSegundos($obj->horafin);
                $horaInicio = Utility::addTimeToDate($fecha . " " . $horaInicio, "1 seconds", "H:i:s");

                $sqlWhere .= " and (select count(*) from horarioatenciondia ha 
                                                    inner join horarioatencion h on ha.horarioatenciondia_id = h.horarioatenciondia_id
                                                    where proveedor_id = p.proveedor_id and horarioatenciondia_dia = $diaSemana 
                                                    and horarioatenciondia_estado = ".ACTIVO." and (('$horaInicio' > horarioatencion_inicio and '$horaInicio' <= horarioatencion_fin) 
                                                    or  ('$horaFin' > horarioatencion_inicio and '$horaFin' <= horarioatencion_fin) 
                                                    or  ('$horaInicio' < horarioatencion_inicio and '$horaFin' >= horarioatencion_fin)
                                                    ) ) > 0  ";


                $sqlSelect .= " , IF((SELECT count(*) FROM reserva 
                                    where reserva_fechaprogramacion = '$fecha' and cancha_id = c.cancha_id and reserva_estado != ".CANCELADO."
                                        and (('$horaInicio' > reserva_horainicio and '$horaInicio' <= reserva_horafin) 
                                        or  ('$horaFin' > reserva_horainicio and '$horaFin' <= reserva_horafin) 
                                        or  ('$horaInicio' < reserva_horainicio and '$horaFin' >= reserva_horafin)
                                    )) > 0, 0, 1) as cancha_disponible";

                $sqlOrder = " order by cancha_disponible desc, p.proveedor_rating desc, distancia desc ";



                //$sqlWhere .= " and (select count(*) from reserva where cancha_id = c.cancha_id and reserva_fechaprogramacion = '$obj->fecha' and reserva_horainicio >= '$horaInicio' and reserva_horafin <= '$horaFin' ) = 0";

            }else{
                $sqlWhere .= " and (select count(*) from horarioatenciondia where proveedor_id = p.proveedor_id and horarioatenciondia_dia = $diaSemana and horarioatenciondia_estado = ".ACTIVO." ) > 0  ";
            }
        }

        $verificarDistancia = true;

        if((isset($obj->proveedor_id) && $obj->proveedor_id > 0)){

            if(Favorito::esProveedorFavorito(Security::getCurrentClienteId(), $obj->proveedor_id)){
                $verificarDistancia = false;
            }
        }

        if($latitud && $longitud && $verificarDistancia){
            $sqlWhere .= " and 
                    (6371 * ACOS(SIN(RADIANS(proveedor_latitud)) * SIN(RADIANS(" . $latitud . ")) 
                                + COS(RADIANS(proveedor_longitud - " . $longitud . ")) * COS(RADIANS(proveedor_latitud)) 
                                * COS(RADIANS(" . $latitud . "))
                                )
                   ) <= $distance_radius
            ";
        }

        $sql = "SELECT SQL_CALC_FOUND_ROWS *, ROUND((6371 * ACOS(SIN(RADIANS(proveedor_latitud)) * SIN(RADIANS(" . $latitud . ")) 
                                + COS(RADIANS(proveedor_longitud - " . $longitud . ")) * COS(RADIANS(proveedor_latitud)) 
                                * COS(RADIANS(" . $latitud . "))
                                )
                   ),2) as distancia $sqlSelect
                from proveedor p
                inner join cancha c on p.proveedor_id = c.proveedor_id
                where  1=1 " . $sqlWhere . "  ".$sqlOrder . $sqlLimit;
        $stmt = $pdo->prepare($sql);


        if($pagina != 0){

            $stmt->bindValue(':start', $start, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        }


        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Cancha');
        $result = $pdo->query("SELECT FOUND_ROWS() AS totalCount");
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        while ($obj = $stmt->fetch()) {
            $_vector[] = $obj;
        }
        return array("cancha_array" => $_vector, "totalCount" => $row["totalCount"]);
    }

    public function getMontoPagarReserva($obj = null, $clavehinicio = null, $clavehfin = null, $fecha = null, $formatearNumero = SI, $esProveedor = NO){
        $canchaprecio = $this->getCanchaPrecioCustom($obj, $clavehinicio, $clavehfin, $fecha, $esProveedor);
        $proveedor = Proveedor::getById($this->proveedor_id);
        $comision = $proveedor->calcularComisionGanada($canchaprecio);

        $porcentajeRecerva = Utility::divideTwoNumbers($proveedor->proveedor_porcetanjereserva * 1, 100);
        $monto = $comision +  $canchaprecio * $porcentajeRecerva;
        $monto = round($monto,0, PHP_ROUND_HALF_UP);

        if($formatearNumero == SI){
            return Utility::formatearNumero($monto);
        }

        return round($monto,2);


    }

    public function getMontoTotalPagar($obj = null, $clavehinicio = null, $clavehfin = null, $formatearNumero = SI, $esProveedor = NO, $fecha = null){

        $canchaprecio = $this->getCanchaPrecioCustom($obj, $clavehinicio, $clavehfin, $fecha, $esProveedor);

        $proveedor = Proveedor::getById($this->proveedor_id);

        $comision = $proveedor->calcularComisionGanada($canchaprecio);

        if($esProveedor == SI){

            $monto = ceil($canchaprecio * 1);

        }else{

            $monto = ceil($canchaprecio * 1  + $comision);

        }


        if($formatearNumero == SI){
            return Utility::formatearNumero($monto);
        }

        return round($monto,2);

    }

    public static function calcularMontoTotalPagar($cancha, $obj = null){
        $canchaprecio = $cancha->getCanchaPrecioCustom($obj, "horainicio", "horafin", "fecha");
        $proveedor = Proveedor::getById($cancha->proveedor_id);
        $comision = $proveedor->calcularComisionGanada($canchaprecio);

        $monto = ceil($canchaprecio * 1  + $comision);

        return Utility::formatearNumero($monto);
    }

    public static function getDeportesByProveedor($proveedor_id){

        global $pdo;


        $_vector = array();



        /*$sql = "select d.*
                from deporte d 
                inner join cancha c on d.deporte_id = c.deporte_id
                where proveedor_id = $proveedor_id and cancha_estado = ".ACTIVO." group by c.deporte_id";

        $stmt = $pdo->prepare($sql);

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Deporte");
        while ($obj = $stmt->fetch()) {
            $_vector[] = $obj;
        }*/
        return $_vector;
    }

    public static function stringDeportes($array_data){
        $array_string = Utility::getListByAtributo("deporte_nombre", $array_data);

        return implode(", ", $array_string);
    }

    public static function getSizeByProveedor($proveedor_id){

        global $pdo;


        $_vector = array();



        $sql = "select distinct (cancha_size)
                from cancha c
                where proveedor_id = $proveedor_id and cancha_estado = ".ACTIVO." ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        while ($obj = $stmt->fetch()) {
            $obj->cancha_sizetext = "Para " . Cancha::getSizeText($obj->cancha_size);
            $_vector[] = $obj;
        }
        return $_vector;
    }

    public static function canchaDisponibleByFechaHora($cancha_id, $obj = null)
    {

        if(isset($obj->fecha) && $obj->fecha != PARAM_TODOS) {


            if (isset($obj->horainicio) && isset($obj->horafin)) {

                $disponible = Reserva::validarFechaReservaDisponible($cancha_id, $obj->fecha, $obj->horainicio, $obj->horafin);

                return $disponible ? SI : NO;

            }


        }

        return SI;


    }

    public static function getTotalCanchasByProveedor($proveedor_id = REST_TODOS, $deporte_id = REST_TODOS){
        global $pdo;



        $sqlWhere = "";

        if($proveedor_id != REST_TODOS){
            $sqlWhere .= " and proveedor_id = $proveedor_id ";
        }
        if($deporte_id != REST_TODOS){
            $sqlWhere .= " and deporte_id = $deporte_id ";
        }


        $sql = "select count(*) as total
                FROM cancha 
                where cancha_estado = ".ACTIVO." 
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

    public static function getCanchasByProveedorDeporte($proveedor_id, $deporte_id){

        global $pdo;


        $_vector = array();
        $sqlWhere = "";

        if($deporte_id != REST_TODOS){
            $sqlWhere .= " and deporte_id = $deporte_id";
        }



        $sql = "select *
                from cancha c
                where proveedor_id = $proveedor_id and cancha_estado = ".ACTIVO." " . $sqlWhere;

        $stmt = $pdo->prepare($sql);

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Cancha");
        while ($obj = $stmt->fetch()) {
            $proveedor = Proveedor::getById($obj->proveedor_id);
            $size = Cancha::getSizeText($obj->cancha_size);
            $obj->cancha_nombrefull = $obj->cancha_nombre . " para " . $size;
            $obj->cancha_precio = $obj->getCanchaPrecioCustom();
            $obj->beneficioList = Proveedorcaracteristica::obtenerCaracteristicaListByProveedor($obj->proveedor_id);
            $obj->cancha_sizetext = $size;
            if ($proveedor) {
                $obj->proveedor_rating = $proveedor->getProveedor_rating();
            }
            if(!isset($obj->sportplatform_avalible)){
                $obj->sportplatform_avalible = Cancha::canchaDisponibleByFechaHora($obj->cancha_id, $obj);
            }
            $_vector[] = $obj;
        }
        return $_vector;
    }

    public function getCanchaPrecioCustom($obj = null, $clavehinicio = null, $clavehfin = null, $clavefecha = null, $esproveedor = NO){

        $diferenciaHoras = Utility::calcularDiferenciaHoras($obj, $clavehinicio, $clavehfin);

        /*
         * PRECIO POR DIA Y HORA
         */
        $fecha = null;
        if(isset($obj->$clavefecha)){
            $fecha = $obj->$clavefecha;
        }

        $canchaPrecio = Canchaprecio::getPrecioDiaActualCancha($this->cancha_id, $fecha);

        /*
         * PRECIO OFERTA
         */

        if($esproveedor == NO){

            $this->cancha_preciohora = $canchaPrecio->canchaprecio_valoroferta;
            $this->cancha_usapreciohora = $canchaPrecio->canchaprecio_estado;
            $this->cancha_inicio = $canchaPrecio->canchaprecio_horainiciooferta;
            $this->cancha_fin = $canchaPrecio->canchaprecio_horafinoferta;

            if($this->cancha_usapreciohora == SI && !Utility::valorEstaVacio($this->cancha_preciohora)
                && !Utility::valorEstaVacio($this->cancha_inicio) && !Utility::valorEstaVacio($this->cancha_fin)){

                $hora = null;
                if(isset($obj->horainicio)){
                    $hora = $obj->horainicio.":01";
                }

                if(Utility::horaEstaDentroRango($hora, $this->cancha_inicio, $this->cancha_fin)){

                    return round($this->cancha_preciohora * $diferenciaHoras, 2);
                }

            }

        }


        /*
         * PRECIO NORMAL
         */

        $this->cancha_preciohora = $canchaPrecio->canchaprecio_valor;
        $this->cancha_usapreciohora = $canchaPrecio->canchaprecio_estado;
        $this->cancha_inicio = $canchaPrecio->canchaprecio_horainicio;
        $this->cancha_fin = $canchaPrecio->canchaprecio_horafin;

        if($this->cancha_usapreciohora == SI && !Utility::valorEstaVacio($this->cancha_preciohora) && !Utility::valorEstaVacio($this->cancha_inicio) && !Utility::valorEstaVacio($this->cancha_fin)){
            $hora = null;
            if(isset($obj->horainicio)){
                $hora = $obj->horainicio.":01";
            }
            if(Utility::horaEstaDentroRango($hora, $this->cancha_inicio, $this->cancha_fin)){
                return round($this->cancha_preciohora * $diferenciaHoras, 2);
            }
        }

        return round($this->cancha_precio * $diferenciaHoras, 2);
    }

    public static function getCanchasParaPadresByProveedor($proveedor_id, $cancha_id = REST_TODOS){

        global $pdo;


        $_vector = array();
        $sqlWhere = "";

        if($cancha_id != REST_TODOS){
            $sqlWhere .= " and cancha_id != $cancha_id";
        }

        if($proveedor_id != REST_TODOS){
            $sqlWhere .= " and proveedor_id = $proveedor_id";
        }



        $sql = "select *
                from cancha c
                where cancha_padreid is null " . $sqlWhere;

        $stmt = $pdo->prepare($sql);

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Cancha");
        while ($obj = $stmt->fetch()) {
            $_vector[] = $obj;
        }
        return $_vector;
    }

    public function guardarHorarioPrecio($array_obj)
    {
        foreach ($array_obj as $diaprecio) {
            if (isset($diaprecio->canchaprecio_id) && $diaprecio->canchaprecio_id > 0) {
                $had = new Canchaprecio(get_object_vars($diaprecio));
                $had->update();

            } else {
                $had = new Canchaprecio(get_object_vars($diaprecio));
                $had->cancha_id = $this->cancha_id;
                $resultado = $had->insert();
            }
        }
    }

    public function validarDatosReserva($obj){

        $mensajes = array();

        if(!isset($obj->fechaprogramacion)){
            $mensajes[] = "La fecha de programacion es obligatoria.";
            return $mensajes;
        }else{
            if (!Utility::esFechaValida($obj->fechaprogramacion,"Y-m-d")) {
                $mensajes[] = "La fecha de programacion no es válida.";
                return $mensajes;
            }
        }

        if(!isset($obj->horainicio)){
            $mensajes[] = "La hora de inicio es obligatoria.";
            return $mensajes;
        }

        if(!isset($obj->horafin)){
            $mensajes[] = "La hora de fin es obligatoria.";
            return $mensajes;
        }

        if($obj->fechaprogramacion == Utility::getFechaActual()){
            if(Utility::fechaAesMayorFechab(Utility::getFechaHoraActual(),$obj->fechaprogramacion . " " . Utility::formatearHoraSinSegundos($obj->horainicio), false)){
                $mensajes[] = "La hora de inicio debe ser mayor a la actual.";
                return $mensajes;
            }
        }elseif (Utility::fechaAesMayorFechab(Utility::getFechaActual(), $obj->fechaprogramacion)){
            $mensajes[] = "La fecha de reserva debe ser mayor o igual a la fecha actual.";
            return $mensajes;
        }

        if(!Reserva::validarFechaReservaPadreDisponible($this->cancha_id, $obj->fechaprogramacion, $obj->horainicio, $obj->horafin, $this->cancha_padreid)){
            $mensajes[] = "La Reserva que deseá realizar ya se encuentra ocupada";
            return $mensajes;
        }


        return $mensajes;

    }

    public static function getCanchasActivasProveedor($proveedor_id){

        global $pdo;


        $_vector = array();



        $sql = "select *
                from deporte d 
                inner join cancha c on d.deporte_id = c.deporte_id
                where proveedor_id = $proveedor_id and cancha_estado = ".ACTIVO." ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        while ($obj = $stmt->fetch()) {

            $obj->cancha_sizetext = Cancha::getSizeText($obj->cancha_size);
            $_vector[] = $obj;
        }
        return $_vector;
    }





}
?>