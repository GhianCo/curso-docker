<?php 
class CanchaController { 
     function __construct() { 
        $db = DB::getInstance();
        $pdo = $db->dbh;
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    public function add($obj) {
    	$data = array();
    	$mensajes = array();
    	$tipo = SUCCESS;
    	$datos = '';
    	if (empty($mensajes)) {
    		$obj = new Cancha($obj);
            $obj->cancha_estado = ACTIVO;
    		$resultado = $obj->insert();
    		if ($resultado) {
    		    if(isset($obj->canchaImagenList) && sizeof($obj->canchaImagenList) && is_array($obj->canchaImagenList)){
                    $obj->agregarImagenes($obj->canchaImagenList);
                }
    		    if(isset($obj->precioHoraList) && sizeof($obj->precioHoraList) && is_array($obj->precioHoraList)){
                    $obj->guardarHorarioPrecio($obj->precioHoraList);
                }

    			$tipo = SUCCESS;
    			$mensajes[] = 'Se agregó con éxito.';

                $datos = $this->getFormatSportplatformDTO($obj);

            } else {
    			$tipo = DANGER;
    			$mensajes[] = 'Se produjo un error al crear. Inténtalo de nuevo.';
    		}
    	}
    	$data['mensajes'] = $mensajes;
    	$data['tipo'] = $tipo;
    	$data['data'] = $datos;
    	return $data;
    }
    
    public function update($obj) {
    	$data = array();
    	$mensajes = array();
    	$tipo = SUCCESS;
    	$datos = null;

    	if (empty($mensajes)) {
    		$obj=new Cancha($obj);
    		$resultado = $obj->update();
    		if ($resultado) {
                if(isset($obj->canchaImagenList) && sizeof($obj->canchaImagenList) && is_array($obj->canchaImagenList)){
                    $obj->agregarImagenes($obj->canchaImagenList);
                }
                if(isset($obj->precioHoraList) && is_array($obj->precioHoraList)){

                    $obj->guardarHorarioPrecio($obj->precioHoraList);

                }else{

                    if(isset($obj->cancha_preciohora)){

                        $array_ph = Canchaprecio::getHorarioDiaByID($obj->cancha_id);
                        foreach ($array_ph as $ph){
                            $ph->delete();
                        }

                        if($obj->cancha_preciohora != null && $obj->cancha_preciohora != "" && isset($obj->cancha_usapreciohora)  && $obj->cancha_usapreciohora == SI){

                            $obj->precioHoraList = array();

                            for ($i = 1; $i<=7; $i++){

                                $objP = new Canchaprecio();
                                $objP->cancha_id = $obj->cancha_id;
                                $objP->canchaprecio_dia = $i;
                                $objP->canchaprecio_estado = 1;

                                $objP->canchaprecio_horainicio = $obj->cancha_inicio;
                                $objP->canchaprecio_horafin = $obj->cancha_fin;
                                $objP->canchaprecio_valor = $obj->cancha_preciohora;
                                $obj->precioHoraList[] = $objP;
                            }

                            $obj->guardarHorarioPrecio($obj->precioHoraList);

                        }
                    }
                }

    			$tipo = SUCCESS;
    			$mensajes[] = 'Se actualizó con éxito.';

    			$datos = $this->getFormatSportplatformDTO($obj);

    		} else {
    			$tipo = DANGER;
    			$mensajes[] = 'Se produjo un error al modificar. Inténtalo de nuevo.';
    		}
    	}
    	$data['mensajes'] = $mensajes;
    	$data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }
    
    public function getById($id) {
    	$data = array();
    	$mensajes = array();
    	$tipo = SUCCESS;
    	$datos = Cancha::getById($id);
    	if(!$datos){
    		$mensajes[] = 'Error, Valor no Encontrado';
    		$tipo = DANGER;
    	}
    	$data['mensajes'] = $mensajes;
    	$data['tipo'] = $tipo;
    	$data['data'] = $datos;
    	return $data;
    }
    
    public function delete($id) {
    	$data = array();
    	$mensajes = array();
    	$tipo = SUCCESS;
    	$obj = Cancha::getById($id);
    	if($obj!=false){
    	$obj->delete();
    	}else{
    		$mensajes[] = 'Error, Valor no Encontrado';
    		$tipo = DANGER;
    	}
    	$data['mensajes'] = $mensajes;
    	$data['tipo'] = $tipo;
    	return $data;
    }
    
    public function listarPorPaginacion($busqueda, $proveedor_id, $pagina, $registros) {
    	$data = array();
    	$mensajes = array();
    	$tipo = SUCCESS;
      $sqlWhere = array();
      if($busqueda != REST_TODOS){
      	$sqlWhere[] = array('field'=>'cancha_nombre','value'=>"%".$busqueda."%",'operator'=>'like');
      }

      if($proveedor_id != REST_TODOS){
      	$sqlWhere[] = array('field'=>'proveedor_id','value'=>$proveedor_id,'operator'=>'=');
      }
    	$array_salida = Cancha::getByFields($sqlWhere,array(),($pagina-1)*$registros,$registros);
    	$totalCount=$array_salida['totalCount'];
    	$array_salida=$array_salida['cancha_array'];
    	$datos=$array_salida;

    	foreach ($datos as $cancha){
            $cancha->deporte = Deporte::getById($cancha->deporte_id);
            $cancha->proveedor = Proveedor::getById($cancha->proveedor_id);
            $cancha->cancha_tipotext = Cancha::getTipoText($cancha->cancha_tipo);
            $cancha->cancha_sizetext = Cancha::getSizeText($cancha->cancha_size);
        }

    	$data['mensajes'] = $mensajes;
    	$data['tipo'] = $tipo;
    	$data['data'] = $datos;
    	$data['totalregistros'] = $totalCount;
    	return $data;
    }
    
    public function getAllActivos() {
    	$data = array();
    	$mensajes = array();
    	$tipo = SUCCESS;
    	$array_salida = Cancha::getByFields(array(
    	array('field'=>'cancha_estado','value'=>'1','operator'=>'=')
    	));
    	$datos=$array_salida['cancha_array'];
    	$data['mensajes'] = $mensajes;
    	$data['tipo'] = $tipo;
    	$data['data'] = $datos;
    	return $data;
    }

    public function busquedaAvanzada($obj){

        $data = array();
        $tipo = SUCCESS;
        $mensajes = array();

        $datos = array();


        if(empty($mensajes)){
            if(isset($obj->query)){

                $obj->query = trim($obj->query);

                if(strlen($obj->query)>1){

                    $busqueda  = Utility::normalizarString(Utility::setLower($obj->query));


                    $canchaList = Cancha::getCanchaListParaBusqueda($busqueda);

                    foreach ($canchaList as $cancha){
                        $cancha->cancha_tipotext = Cancha::getTipoText($cancha->cancha_tipo);
                        $cancha->cancha_sizetext = Cancha::getSizeText($cancha->cancha_size);
                    }


                    $datos = $canchaList;


                    $mensajes[] = "Busqueda realizada";

                }else{

                    $tipo =  SUCCESS;
                    $mensajes[] = "No existe nada por buscar";

                }

            }else{

                $tipo =  ERROR;
                $mensajes[] = "No se envio la busqueda";
            }
        }


        $data["tipo"] = $tipo;
        $data["mensajes"] = $mensajes;
        $data["data"] = $datos;
        return $data;

    }


    public function getTipos() {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;


        $datos = Cancha::getTipos();

        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }

    public function getSizes() {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;


        $datos = Cancha::getSizes();

        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }

    public function getImagenes($id) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;


        $cancha = Cancha::getById($id);
        $datos = $cancha->getImagenes();

        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }

    public function getHorarioAtenciaVacio() {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;


        $horarioatenciondia_array = array();

        $lunes = new Horarioatenciondia();
        $lunes->horarioatenciondia_estado = INACTIVO;
        $lunes->horarioatenciondia_dia = LUNES;
        $lunes->horarioatencionList = array(array("horarioatencion_id"=>null,"horarioatencion_inicio"=>null,"horarioatencion_fin"=>null,"horarioatenciondia_id"=>null));
        $horarioatenciondia_array[]=$lunes;

        $martes = new Horarioatenciondia();
        $martes->horarioatenciondia_id = null;
        $martes->horarioatenciondia_estado = INACTIVO;
        $martes->horarioatenciondia_dia = MARTES;
        $martes->horarioatencionList = array(array("horarioatencion_id"=>null,"horarioatencion_inicio"=>null,"horarioatencion_fin"=>null,"horarioatenciondia_id"=>null));
        $horarioatenciondia_array[]=$martes;

        $miercoles = new Horarioatenciondia();
        $miercoles->horarioatenciondia_id = null;
        $miercoles->horarioatenciondia_estado = INACTIVO;
        $miercoles->horarioatenciondia_dia = MIERCOLES;
        $miercoles->horarioatencionList = array(array("horarioatencion_id"=>null,"horarioatencion_inicio"=>null,"horarioatencion_fin"=>null,"horarioatenciondia_id"=>null));
        $horarioatenciondia_array[]=$miercoles;

        $jueves = new Horarioatenciondia();
        $jueves->horarioatenciondia_id = null;
        $jueves->horarioatenciondia_estado = INACTIVO;
        $jueves->horarioatenciondia_dia = JUEVES;
        $jueves->horarioatencionList = array(array("horarioatencion_id"=>null,"horarioatencion_inicio"=>null,"horarioatencion_fin"=>null,"horarioatenciondia_id"=>null));
        $horarioatenciondia_array[]=$jueves;

        $viernes = new Horarioatenciondia();
        $viernes->horarioatenciondia_id = null;
        $viernes->horarioatenciondia_estado = INACTIVO;
        $viernes->horarioatenciondia_dia = VIERNES;
        $viernes->horarioatencionList = array(array("horarioatencion_id"=>null,"horarioatencion_inicio"=>null,"horarioatencion_fin"=>null,"horarioatenciondia_id"=>null));
        $horarioatenciondia_array[]=$viernes;

        $sabado = new Horarioatenciondia();
        $sabado->horarioatenciondia_id = null;
        $sabado->horarioatenciondia_estado = INACTIVO;
        $sabado->horarioatenciondia_dia = SABADO;
        $sabado->horarioatencionList = array(array("horarioatencion_id"=>null,"horarioatencion_inicio"=>null,"horarioatencion_fin"=>null,"horarioatenciondia_id"=>null));
        $horarioatenciondia_array[]=$sabado;

        $domingo = new Horarioatenciondia();
        $domingo->horarioatenciondia_id = null;
        $domingo->horarioatenciondia_estado = INACTIVO;
        $domingo->horarioatenciondia_dia = DOMINGO;
        $domingo->horarioatencionList = array(array("horarioatencion_id"=>null,"horarioatencion_inicio"=>null,"horarioatencion_fin"=>null,"horarioatenciondia_id"=>null));
        $horarioatenciondia_array[]=$domingo;



        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $horarioatenciondia_array;
        return $data;
    }


    public function getHorarioAtencion($proveedor_id) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;



        $horarioatenciondia_array = Horarioatenciondia::getHorarioByID($proveedor_id);

        if(sizeof($horarioatenciondia_array) == 0){
            $horarioatenciondia_array = self::getHorarioAtenciaVacio()["data"];
        }else{
            foreach ($horarioatenciondia_array as $had) {

                foreach ($had->horarioatencionList as $horarioatencion) {
                    if ($horarioatencion->horarioatencion_inicio) {
                        $date = new DateTime('2000-01-01 ' . $horarioatencion->horarioatencion_inicio);
                        $horarioatencion->horarioatencion_inicio = $date->format('H:i');
                    }
                    if ($horarioatencion->horarioatencion_fin) {
                        $date = new DateTime('2000-01-01 ' . $horarioatencion->horarioatencion_fin);
                        $horarioatencion->horarioatencion_fin = $date->format('H:i');
                    }
                }
            }
        }


        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $horarioatenciondia_array;
        return $data;
    }


    public function getInformacionCancha($cancha_id) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = null;


        $objSalida = new stdClass();
        $cancha = Cancha::getById($cancha_id);
        $proveedor = Proveedor::getById($cancha->proveedor_id);
        $deporte = Deporte::getById($cancha->deporte_id);

        $objSalida->cancha_id = $cancha->cancha_id;
        $objSalida->proveedor_nombre = $proveedor->proveedor_nombre;
        $objSalida->proveedor_latitud = $proveedor->proveedor_latitud;
        $objSalida->proveedor_longitud = $proveedor->proveedor_longitud;
        $objSalida->cancha_nombre = $cancha->cancha_nombre;
        $objSalida->direccion = $proveedor->proveedor_direccion;
        $objSalida->referencia = $proveedor->proveedor_referencia;
        $objSalida->horarioList = $proveedor->getHorarioAtencioHoy();
        $objSalida->deporte = $deporte->deporte_nombre;
        $objSalida->imagenList = $cancha->getImagenes();


        $datos = $objSalida;


        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }

    public function getFiltrosCancha() {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;


        $objSalida = new stdClass();
        $objSalida->tipoList = Cancha::getTipos();
        $objSalida->caracteristicaList = Caracteristica::getAllActivos();
        $objSalida->sizeList = Cancha::getSizes();


        $datos = $objSalida;


        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }

    public function getCanchaList($pagina, $registros, $obj) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = array();
        $totalCount = 0;

        if(!isset($obj->horainicio)){
            $mensajes[] = "Seleccione la hora reserva";
            $tipo = DANGER;
        }

        if(empty($mensajes)){

            $latitud = 0;
            $longitud = 0;

            if(isset($obj->latitud)) $latitud = $obj->latitud;
            if(isset($obj->longitud)) $longitud = $obj->longitud;

            $array_salida = Cancha::getListaPaginacionByFiltros($pagina, $registros, $obj);
            $totalCount=$array_salida['totalCount'];
            $canchaList = $array_salida['cancha_array'];

            foreach ($canchaList as $cancha){

                $cancha->cancha_tipotext = Cancha::getTipoText($cancha->cancha_tipo);
                $cancha->rango_horariotext = Proveedor::getHorarioTextHoy($cancha->proveedor_id);
                $cancha->cancha_sizetext = Cancha::getSizeText($cancha->cancha_size);
                $cancha->{"distancia"} = number_format(Utility::distance($latitud, $longitud, $cancha->proveedor_latitud, $cancha->proveedor_longitud, "K"),2, ".", "") ;
                $cancha->{"distanciatext"} = $cancha->{"distancia"} . " " . "KM";
                $cancha->esfavorito = Favorito::esProveedorFavorito(Security::getCurrentClienteId(), $cancha->proveedor_id);

                if(!isset($cancha->cancha_disponible)){
                    $cancha->cancha_disponible = Cancha::canchaDisponibleByFechaHora($cancha->cancha_id, $obj);
                }

                if($cancha->cancha_disponible == SI){

                    if(!Reserva::validarFechaReservaPadreDisponible($cancha->cancha_id, $obj->fecha, $obj->horainicio, $obj->horafin, $cancha->cancha_padreid)){
                        $cancha->cancha_disponible = NO;
                    }

                }
                $cancha->cancha_precio = Cancha::calcularMontoTotalPagar($cancha, $obj);

                $cancha->imagenList = $cancha->getImagenes();

            }

            $datos = $canchaList;

        }


        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        $data['totalregistros'] = $totalCount;
        return $data;
    }

    public function getMontoPagar($obj) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = null;

        if(!isset($obj->cancha_id)){
            $tipo = ERROR;
            $mensajes[] = "El cancha_id es obligatorio.";
        }

        if(empty($mensajes)){
            $cancha = Cancha::getById($obj->cancha_id);
            $esProveedor = NO;
            if(Security::getUsuarioProveedorIdByToken(Security::getToken()) > 0){
                $esProveedor = SI;
            }

            $objSalida = new stdClass();
            $objSalida->monto_reserva = $cancha->getMontoPagarReserva($obj, "horainicio", "horafin", "fechaprogramacion", NO, $esProveedor);
            $objSalida->monto_total = $cancha->getMontoTotalPagar($obj, "horainicio", "horafin", NO, $esProveedor, "fechaprogramacion");
            $objSalida->monto_pagarencancha = round($objSalida->monto_total - $objSalida->monto_reserva,2);

            $datos = $objSalida;
        }



        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }

    public function getCanchaListByParams($provedor_id, $deporte_id) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = null;

        if(empty($mensajes)){

            $datos = Cancha::getCanchasByProveedorDeporte($provedor_id, $deporte_id);

        }

        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }

    public function verificarDisponibilidad($cancha_id, $obj) {
        $data = array();
        $mensajes = array();
        $tipo = ERROR;
        $datos = null;


        $client_id = Security::getClientIdByToken(Security::getToken());

        if($client_id == CLIENTE_VISITANTE){

            $mensajes[] = "Estas con una cuenta de invitado, por favor inicia sesión.";
            $tipo = ERROR;
        }

        if(empty($mensajes)){

            if($client_id <= 0){
                if(!isset($obj->proveedor_id)){
                    $mensajes[] = "El proveedor es obligatorio.";
                }
            }
        }

        if(empty($mensajes)){

            $cancha = Cancha::getById($cancha_id);

            if(!$cancha){
                $tipo = ERROR;
                $mensajes[] = "Cancha no existe.";
            }

        }

        if(empty($mensajes)){
            $mensajes =  $cancha->validarDatosReserva($obj);
        }



        if(empty($mensajes)){

            if($client_id <= 0){
                Bloqueo::eliminarBloqueosProveedor($obj->proveedor_id, $cancha->cancha_id, $obj->fechaprogramacion, $obj->horainicio, $obj->horafin);
            }else{
                Bloqueo::eliminarBloqueosCliente($client_id, $cancha->cancha_id, $obj->fechaprogramacion, $obj->horainicio, $obj->horafin);
            }

            if(Bloqueo::validarFechaCanchaDisponible($cancha->cancha_id, $obj->fechaprogramacion, $obj->horainicio, $obj->horafin, $cancha->cancha_padreid)){

                $proveedor_id = Security::getUsuarioProveedorIdByToken(Security::getToken());
                Bloqueo::eliminarBloqueosProveedor($proveedor_id);

                $bloqueo = Bloqueo::agregarBloqueo($cancha->cancha_id, $obj, $client_id);
                $tipo = SUCCESS;
                $mensajes[] = "Se bloqueo esta reserva por " . MINUTOS_BLOQUEO . " minutos";
                $datos = $bloqueo->bloqueo_fecha;

            }else{

                $tipo = ERROR;
                $mensajes[] = "Alguien está reservando este lugar, por favor inténtalo en un momento.";

            }


        }


        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }

    public function borrarBloqueoCliente() {
        $data = array();
        $mensajes = array();
        $tipo = ERROR;
        $datos = null;

        if(empty($mensajes)){

            $client_id = Security::getClientIdByToken(Security::getToken());
            Bloqueo::eliminarBloqueosCliente($client_id);

            $tipo = SUCCESS;
            $mensajes[] = "Se elimino los bloqueos de este cliente.";


        }


        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }

    public function borrarBloqueoProveedor() {
        $data = array();
        $mensajes = array();
        $tipo = ERROR;
        $datos = null;

        if(empty($mensajes)){

            // comenntado xq hay un problema en nla app borrando esto
            //$proveedor_id = Security::getUsuarioProveedorIdByToken(Security::getToken());
            //Bloqueo::eliminarBloqueosProveedor($proveedor_id);

            $tipo = SUCCESS;
            $mensajes[] = "Se elimino los bloqueos de este proveedor.";


        }


        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }


    public function getDetailSportplataform($id) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = Cancha::getById($id);
        if(!$datos){
            $mensajes[] = 'Error, Valor no Encontrado';
            $tipo = DANGER;
        }else{
            $datos->canchaImagenList = $datos->getImagenes();
        }
        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }

    public function getCanchasParaPadres($proveedor_id, $id) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;

        if(empty($mensajes)){
            if($proveedor_id == REST_TODOS && $id != REST_TODOS) $proveedor_id = Cancha::getById($id)->proveedor_id;

            $datos = Cancha::getCanchasParaPadresByProveedor($proveedor_id, $id);
        }
        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }

    public function getHorarioCanchaPrecio() {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;


        $canchaprecio_array = array();

        $lunes = new Canchaprecio();
        $lunes->canchaprecio_estado = INACTIVO;
        $lunes->canchaprecio_dia = LUNES;
        $canchaprecio_array[]=$lunes;

        $martes = new Canchaprecio();
        $martes->canchaprecio_id = null;
        $martes->canchaprecio_estado = INACTIVO;
        $martes->canchaprecio_dia = MARTES;
        $canchaprecio_array[]=$martes;

        $miercoles = new Canchaprecio();
        $miercoles->canchaprecio_id = null;
        $miercoles->canchaprecio_estado = INACTIVO;
        $miercoles->canchaprecio_dia = MIERCOLES;
        $canchaprecio_array[]=$miercoles;

        $jueves = new Canchaprecio();
        $jueves->canchaprecio_id = null;
        $jueves->canchaprecio_estado = INACTIVO;
        $jueves->canchaprecio_dia = JUEVES;
        $canchaprecio_array[]=$jueves;

        $viernes = new Canchaprecio();
        $viernes->canchaprecio_id = null;
        $viernes->canchaprecio_estado = INACTIVO;
        $viernes->canchaprecio_dia = VIERNES;
        $canchaprecio_array[]=$viernes;

        $sabado = new Canchaprecio();
        $sabado->canchaprecio_id = null;
        $sabado->canchaprecio_estado = INACTIVO;
        $sabado->canchaprecio_dia = SABADO;
        $canchaprecio_array[]=$sabado;

        $domingo = new Canchaprecio();
        $domingo->canchaprecio_id = null;
        $domingo->canchaprecio_estado = INACTIVO;
        $domingo->canchaprecio_dia = DOMINGO;
        $canchaprecio_array[]=$domingo;



        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $canchaprecio_array;
        return $data;
    }

    public function getHorarioCanchaPrecioByID($cancha_id) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;



        $preciodia_array = Canchaprecio::getHorarioDiaByID($cancha_id);

        if(sizeof($preciodia_array) == 0){
            $preciodia_array = self::getHorarioCanchaPrecio()["data"];
        }else{
            foreach ($preciodia_array as $dia) {

                if ($dia->canchaprecio_horainicio) {
                    $date = new DateTime(Utility::getFechaActual(). " ". $dia->canchaprecio_horainicio);
                    $dia->canchaprecio_horainicio = $date->format('H:i');
                }
                if ($dia->canchaprecio_horafin) {
                    $date = new DateTime(Utility::getFechaActual(). " ". $dia->canchaprecio_horafin);
                    $dia->canchaprecio_horafin = $date->format('H:i');
                }
                if ($dia->canchaprecio_horainiciooferta) {
                    $date = new DateTime(Utility::getFechaActual(). " ". $dia->canchaprecio_horainiciooferta);
                    $dia->canchaprecio_horainiciooferta = $date->format('H:i');
                }
                if ($dia->canchaprecio_horafinoferta) {
                    $date = new DateTime(Utility::getFechaActual(). " ". $dia->canchaprecio_horafinoferta);
                    $dia->canchaprecio_horafinoferta = $date->format('H:i');
                }
            }
        }


        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $preciodia_array;
        return $data;
    }

    public function getHorariosLibresPorCancha($cancha_id, $obj){

        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;


        //$array_horas = Utility::getRangoHoras($obj->fecha." 06:00:00", $obj->fecha." 23:59:59");

        //$array_salida = array();

        /*foreach ($array_horas as $hora){

            if(Reserva::validarFechaReservaDisponible($cancha_id, $obj->fecha, $hora->horainicio, $hora->horafin)){
                $array_salida[] = $hora;
            }

        }*/

        $diaSemana = Utility::getDiaSemanaByFecha($obj->fecha);

        $proveedor_id = Security::getUsuarioProveedorIdByToken(Security::getToken());

        $f1 = "02:00:00";
        $f2 = "23:59:59";

        $array_horariosDisponibles = Horarioatenciondia::getHorarioDisponiblesDiaHora($proveedor_id, $diaSemana, $f1, $f2);

        $array_horas = array();
        $array_salida = array();

        foreach ($array_horariosDisponibles as $horario){
            $array_horas = array_merge($array_horas, Utility::getListaHoras($horario));
        }

        foreach ($array_horas as $hora){

            $objHora = new stdClass();
            $objHora->horainicio = $hora->horario_value;

            $start = strtotime($obj->fecha." ".$objHora->horainicio);

            $objHora->horafin = $objHora->horafin = date('H', $start).":59";;
            $objHora->horainicio_vista = $hora->horario_text;

            if(Reserva::validarFechaReservaDisponible($cancha_id, $obj->fecha, $objHora->horainicio, $objHora->horafin)){
                $array_salida[] = $objHora;
            }

        }

        $mensajes[] = "Horas libres";

        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $array_salida;
        return $data;
    }

    public function getFormatSportplatformDTO($obj)
    {
        $proveedor = Proveedor::getById($obj->proveedor_id);
        $size = Cancha::getSizeText($obj->cancha_size);
        $obj->cancha_nombrefull = $obj->cancha_nombre . " para " . $size;
        $obj->cancha_precio = $obj->getCanchaPrecioCustom();
        $obj->beneficioList = Proveedorcaracteristica::obtenerCaracteristicaListByProveedor($obj->proveedor_id);
        $obj->cancha_sizetext = $size;
        if ($proveedor) {
            $obj->proveedor_rating = $proveedor->getProveedor_rating();
        }
        return $obj;
    }
}
?>