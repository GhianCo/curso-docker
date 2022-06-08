<?php 
class ProveedorController { 
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
    		$obj = new Proveedor($obj);
    		$obj->proveedor_fecharegistro = Utility::getFechaHoraActual();
    		$obj->proveedor_encendido = SI;
    		$obj->proveedor_estado = ACTIVO;
    		$resultado = $obj->insert();
    		if ($resultado) {

                if(isset($obj->horarioList) && sizeof($obj->horarioList) && is_array($obj->horarioList)){
                    $obj->guardarHorario($obj->horarioList);
                }
                if(isset($obj->beneficioList) && sizeof($obj->beneficioList) && is_array($obj->beneficioList)){
                    $obj->guardarBeneficios($obj->beneficioList);
                }

    			$tipo = SUCCESS;
    			$mensajes[] = 'Se agregó con éxito.';
    			$datos = $resultado;

                /**
                 * Se crea de manera automatica el vinculo entre cliente y operador
                 */
                Usuarioproveedor::crearVinculoUsuarioProveedor(Security::getCurrentUserId(),$obj->getProveedor_id());

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
    	if (empty($mensajes)) {
    		$obj=new Proveedor($obj);
    		$resultado = $obj->update();
    		if ($resultado) {

                if(isset($obj->horarioList) && sizeof($obj->horarioList) && is_array($obj->horarioList)){
                    $obj->guardarHorario($obj->horarioList);
                }
                if(isset($obj->beneficioList) && sizeof($obj->beneficioList) && is_array($obj->beneficioList)){
                    $obj->guardarBeneficios($obj->beneficioList);
                }

    			$tipo = SUCCESS;
    			$mensajes[] = 'Se actualizó con éxito.';
    		} else {
    			$tipo = DANGER;
    			$mensajes[] = 'Se produjo un error al modificar. Inténtalo de nuevo.';
    		}
    	}
    	$data['mensajes'] = $mensajes;
    	$data['tipo'] = $tipo;
    	return $data;
    }
    
    public function getById($id) {
    	$data = array();
    	$mensajes = array();
    	$tipo = SUCCESS;
    	$datos = Proveedor::getById($id);
    	if(!$datos){
    		$mensajes[] = 'Error, Valor no Encontrado';
    		$tipo = DANGER;
    	}else{
    	    $datos->caracteristicas = Proveedorcaracteristica::obtenerCaracteristicaListByProveedor($datos->proveedor_id);
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
    	$obj = Proveedor::getById($id);
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
    
    public function listarPorPaginacion($busqueda,$pagina,$registros, $todos = NO) {
    	$data = array();
    	$mensajes = array();
    	$tipo = SUCCESS;

    	$filtrarByUsuario = NO;

    	if(Usuarioproveedor::totalProveedores(Security::getCurrentUserId()) > 0){

    	    if($todos == NO){

                $filtrarByUsuario = SI;

            }
        }

    	$array_salida = Proveedor::listarPorPaginacion($busqueda, $filtrarByUsuario, $pagina, $registros);
    	$totalCount=$array_salida['totalCount'];
    	$array_salida=$array_salida['proveedor_array'];
    	$datos=$array_salida;

    	foreach ($datos as $proveedor){

            $proveedor->proveedor_comisiontext = $proveedor->getPorcentajeComisionText();
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
    	$array_salida = Proveedor::getByFields(array(
    	array('field'=>'proveedor_estado','value'=>'1','operator'=>'=')
    	));
    	$datos=$array_salida['proveedor_array'];
    	$data['mensajes'] = $mensajes;
    	$data['tipo'] = $tipo;
    	$data['data'] = $datos;
    	return $data;
    }

    public function getListaPorBusqueda($valor)
    {
        $array_salida = Proveedor::listarPorBusqueda($valor, 10);
        $array_salida = $array_salida["salida_array"];
        return $array_salida;
    }

    function esFavorito($proveedor_id){

        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = null;

        $objProveedor = Proveedor::getById($proveedor_id);

        if($objProveedor){

            $client_id = Security::getCurrentClienteId();

            if($client_id > 0){
                $favorito_id = $objProveedor->favoritoClient($client_id);
                if(!$favorito_id){
                    $objProveedor->crearFavoritoClient($client_id);
                    $mensajes[] = "Se agregó tu proveedor favorito.";
                }else{
                    $favorito = Favorito::getById($favorito_id);
                    if($favorito){
                        $favorito->delete();
                    }
                    $mensajes[] = "Se eliminó este proveedor de tu favorito.";
                }
            }

        }else{
            $tipo = ERROR;
            $mensajes[] = "No se encontro la historia solicitada.";
        }


        $data["mensajes"] = $mensajes;
        $data["tipo"] = $tipo;
        $data["data"] = $datos;

        return $data;
    }

    public function guardarCalificacion($obj){
        $tipo = SUCCESS;
        $mensajes = array();
        $data = array();

        if(!isset($obj->puntuacion)){

            $tipo = ERROR;
            $mensajes[] = "La calificación es requerida";

        }elseif(!is_numeric($obj->puntuacion)){

            $tipo = ERROR;
            $mensajes[] = "La calificación no es valida";

        }elseif(!isset($obj->reserva_id)){

            $tipo = ERROR;
            $mensajes[] = "La reserva_id es requerido";

        }



        if(empty($mensajes)){


            $objReserva = Reserva::getById($obj->reserva_id);

            if($objReserva){

                if($objReserva->getReserva_rating() * 1 > 0){

                    $tipo = ERROR;
                    $mensajes[] = "La reserva ya cuenta con una calificación.";

                }else{
                    $objReserva->setReserva_rating($obj->puntuacion);
                    $objReserva->update();

                    $objProveedor = Proveedor::getById($objReserva->proveedor_id);
                    $objProveedor->calcularRating();

                    $tipo = SUCCESS;
                    $mensajes[] = "Gracias, por brindarnos tu calificación.";
                }



            }else{

                $tipo = ERROR;
                $mensajes[] = "La reserva no existe";

            }

        }
        $data["tipo"] = $tipo;
        $data["mensajes"] = $mensajes;
        return $data;
    }

    public function getHorariosDisponibles($obj){
        $tipo = SUCCESS;
        $mensajes = array();
        $data = array();
        $datos = array();

        if(!isset($obj->fecha)){

            $tipo = ERROR;
            $mensajes[] = "La fecha es requerida";

        }elseif(!isset($obj->proveedor_id)){

            $tipo = ERROR;
            $mensajes[] = "El proveedor_id es requerido";

        }elseif(!isset($obj->horainicio)){

            $tipo = ERROR;
            $mensajes[] = "La hora de inicio es requerido";

        }elseif(!isset($obj->horafin)){

            $tipo = ERROR;
            $mensajes[] = "La hora de fin es requerido";

        }


        if(empty($mensajes)){


            $objProveedor = Proveedor::getById($obj->proveedor_id);

            if($objProveedor){

                $diaSemana = Utility::getDiaSemanaByFecha($obj->fecha);

                $array_horariosDisponibles = Horarioatenciondia::getHorarioDisponiblesDiaHora($objProveedor->proveedor_id, $diaSemana, $obj->horainicio, $obj->horafin);

                $array_horas = array();

                foreach ($array_horariosDisponibles as $horario){
                    $array_horas = array_merge($array_horas, Utility::getListaHoras($horario));
                }

                $datos = $array_horas;


            }else{

                $tipo = ERROR;
                $mensajes[] = "El proveedor no existe";

            }

        }
        $data["tipo"] = $tipo;
        $data["mensajes"] = $mensajes;
        $data["data"] = $datos;
        return $data;
    }

    public function getInformacion($proveedor_id) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = null;


        $objSalida = new stdClass();
        $proveedor = Proveedor::getById($proveedor_id);

        $objSalida->proveedor_id = $proveedor->proveedor_id;
        $objSalida->proveedor_nombre = $proveedor->proveedor_nombre;
        $objSalida->proveedor_latitud = $proveedor->proveedor_latitud;
        $objSalida->proveedor_longitud = $proveedor->proveedor_longitud;
        $objSalida->proveedor_urllogo = $proveedor->proveedor_urllogo;
        $objSalida->direccion = $proveedor->proveedor_direccion;
        $objSalida->referencia = $proveedor->proveedor_referencia;
        $objSalida->horarioList = $proveedor->getHorarioAtencioHoy();

        foreach ($objSalida->horarioList as $horario){

            if(isset($horario->dia) && strlen($horario->dia)>2){
                //$horario->dia = substr($horario->dia, 0, 2);
            }
            //$horario->hora_inicio = str_replace(":00",":0", $horario->hora_inicio);
        }

        $objSalida->imagenList = Canchaimagen::getImagenesByProveedor($proveedor->proveedor_id);
        $deporteList = Cancha::getDeportesByProveedor($proveedor->proveedor_id);
        $objSalida->deporte = Cancha::stringDeportes($deporteList);
        $objSalida->sizeList = Cancha::getSizeByProveedor($proveedor->proveedor_id);
        $objSalida->esfavorito = Favorito::esProveedorFavorito(Security::getCurrentClienteId(), $proveedor->proveedor_id);
        $objSalida->caracteristicaList = Proveedorcaracteristica::obtenerCaracteristicaListByProveedor($proveedor->proveedor_id);

        $datos = $objSalida;


        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }


    public function cabeceraProveedores($obj = null) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = null;



        if (empty($mensajes)) {

            $objDashboard = new stdClass();
            $objDashboard->cantidad_totalcanchas = Cancha::getTotalCanchasByProveedor();
            $objDashboard->total_proveedores = Proveedor::getTotalByProveedorFiltros($obj);


            $datos = $objDashboard;

        }
        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }

    public function reporteProveedores($pagina,$registros, $obj) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;

        $array_salida = Proveedor::reporteProveedores($pagina,$registros, $obj);
        $totalCount=$array_salida['totalCount'];
        $array_salida=$array_salida['proveedor_array'];

        $datos=$array_salida;
        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        $data['totalregistros'] = $totalCount;
        return $data;
    }

    public function getDataDashboard($proveedor_id, $obj) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = null;

        $fechaInicio = isset($obj->fechainicio) ? $obj->fechainicio. " " . HORA_INICIO_FECHA : Utility::getFechaActual() . " " . HORA_INICIO_FECHA;
        $fechaFin = isset($obj->fechafin) ? $obj->fechafin. " " . HORA_FIN_FECHA : Utility::getFechaActual() . " " . HORA_FIN_FECHA;
        $deporte_id = isset($obj->deporte_id) ? $obj->deporte_id : REST_TODOS;


        if (empty($mensajes)) {

            $objDashboard = new stdClass();
            $objDashboard->total_usuarios = Reserva::totalUsuariosActivosReserva($fechaInicio, $fechaFin, $proveedor_id, $deporte_id);
            $objDashboard->total_canchas = Cancha::getTotalCanchasByProveedor($proveedor_id, $deporte_id);
            $objDashboard->deporteList = Cancha::getDeportesByProveedor($proveedor_id);
            $objDashboard->reservaList = Reserva::getReservasConfirmadasByProveedor($fechaInicio, $fechaFin, $proveedor_id, $deporte_id);
            $objDashboard->total_reservas = Reserva::cantidadTotaReservasByFecha($fechaInicio, $fechaFin, $proveedor_id, $deporte_id);
            $objDashboard->total_horasreservas = Reserva::totalHorasReservadas($fechaInicio, $fechaFin, $proveedor_id, $deporte_id);
            $objDashboard->total_reservascanceladas = Reserva::cantidadTotaReservasCanceladasByFecha($fechaInicio, $fechaFin, $proveedor_id, $deporte_id, true);
            $objDashboard->total_ingreso = Reserva::totalPagoIngresosByFecha($fechaInicio, $fechaFin, $proveedor_id, $deporte_id);
            $objDashboard->grafico = Reserva::getGraficoTotalReservaTipo($fechaInicio, $fechaFin, $proveedor_id, $deporte_id);
            $objDashboard->grafico_canal = Reserva::getGraficoTotalReservaCanal($fechaInicio, $fechaFin, $proveedor_id, $deporte_id);

            $resumenPagoList = array();

            $tipopagoList = Utility::getTiposPagoListProveedor();

            $objDashboard->total_ingreso = 0;

            foreach ($tipopagoList as $tipopago){

                if($tipopago->tipopago_id != PAGO_APP && $tipopago->tipopago_id != PAGO_DEPOSITO && $tipopago->tipopago_id != PAGO_ENLINEA){

                    $objTipoPago = new stdClass();
                    $objTipoPago->resumen_nombre = $tipopago->tipopago_nombre;
                    $objTipoPago->resumen_total = Reserva::totalPagoIngresosByFechaTipoPago($fechaInicio, $fechaFin, $tipopago->tipopago_id, $proveedor_id,
                        $deporte_id , PARAM_TODOS, SI, SI);

                    $objDashboard->total_ingreso += $objTipoPago->resumen_total;
                    $resumenPagoList[] = $objTipoPago;

                }
            }

            $totalApp = Reserva::totalPagoIngresosByFechaTipoPago($fechaInicio, $fechaFin, PAGO_DEPOSITO, $proveedor_id, $deporte_id , TIPO_RESERVA_APP, SI, SI);
            $totalApp += Reserva::totalPagoIngresosByFechaTipoPago($fechaInicio, $fechaFin, PAGO_ENLINEA, $proveedor_id, $deporte_id , TIPO_RESERVA_APP, SI, SI);
            $totalApp = $totalApp - Reserva::totalComisionByFecha($fechaInicio, $fechaFin, SI);

            if($totalApp<0)$totalApp = 0;

            $objDashboard->total_ingreso += $totalApp;

            $objDashboard->total_ingreso = Utility::formatearNumero($objDashboard->total_ingreso);

            $resumenPagoList[] = (object)array("resumen_nombre"=>"Ingr/hora",
                "resumen_total" => Utility::divideTwoNumbers($objDashboard->total_ingreso, $objDashboard->total_horasreservas, SI));

            $objTipoPago = new stdClass();
            $objTipoPago->resumen_nombre = Utility::getDescripcionTipoPagoTxt(PAGO_APP);
            $objTipoPago->resumen_total = Utility::formatearNumero($totalApp);
            $resumenPagoList[] = $objTipoPago;

            foreach ($objDashboard->deporteList as $deporte){
                $deporte->total_reservas = Reserva::cantidadReservasByFechaDeporte($fechaInicio, $fechaFin, $deporte->deporte_id, $proveedor_id);
            }

            $resumenPagoList[] = (object)array("resumen_nombre"=>"Devoluciones",
                "resumen_total" => Reserva::totalPagoEgresosByFecha($fechaInicio, $fechaFin, $proveedor_id, $deporte_id, true), "resumen_esnegativo" => SI);

            $objDashboard->resumenPagoList = $resumenPagoList;
            $objDashboard->calendario = Reserva::getCalendario($proveedor_id, $deporte_id);


            $datos = $objDashboard;

        }
        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }

    public function getClienteList($obj) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;

        $obj->fechainicio= "2020-03-23";
        $obj->fechafin= "2090-03-23";
        $array_salida = Proveedor::getClienteListProveedor($obj);
        $totalCount=$array_salida['totalCount'];
        $array_salida=$array_salida['cliente_array'];
        $datos=$array_salida;

        foreach ($datos as $cliente){
            $cliente->fecha_ultimareserva = Reserva::getFechaUltimaReservaByCliente($cliente->cliente_id, $obj);
            $cliente->cantidad_reserva = Reserva::getCantidadReservaByCliente($cliente->cliente_id, $obj);
            $cliente->monto_reserva = Reserva::getMontoTotalReservaByCliente($cliente->cliente_id, $obj);
            $cliente->top_horario = Reserva::getTopHorarioReservaByCliente($cliente->cliente_id, $obj);
            $cliente->top_size = Reserva::getTopSizeReservaByCliente($cliente->cliente_id, $obj);
            $cliente->cliente_estado = Clienteproveedor::clienteInactivoProveedor($cliente->cliente_id, $obj->proveedor_id) ? PARAM_ESTADO_INACTIVO : PARAM_ESTADO_ACTIVO;
        }

        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        $data['totalregistros'] = $totalCount;
        return $data;
    }

    public function updateInformacion($obj) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;

        if(!isset($obj->proveedor_id)){
            $tipo = ERROR;
            $mensajes[] = "ID no valido";
        }else{
            $proveedor = Proveedor::getById($obj->proveedor_id);
            if(!$proveedor){
                $tipo = ERROR;
                $mensajes[] = "Proveedor no encontrado.";
            }
        }


        if (empty($mensajes)) {

            if(isset($obj->horarioList) && sizeof($obj->horarioList) && is_array($obj->horarioList)){
                $proveedor->guardarHorario($obj->horarioList);
            }
            if(isset($obj->beneficioList) && sizeof($obj->beneficioList) && is_array($obj->beneficioList)){
                $proveedor->guardarBeneficios($obj->beneficioList);
            }

            $tipo = SUCCESS;
            $mensajes[] = 'Se actualizó con éxito.';
        }
        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        return $data;
    }

    public function updateFCM($item_array){
        $data = array();
        $tipo = SUCCESS;
        $mensajes = array();
        $datos = null;

        if(!array_key_exists("token_fcm",$item_array)){
            $tipo = ERROR;
            $mensajes[] = "No ha enviado un token_fcm";
        }
        if(empty($mensajes)){
            $tokenObj = Security::getTokenProveedorObj();
            if($tokenObj){
                $tokenObj->tokenproveedor_fcm = $item_array["token_fcm"];
                $tokenObj->update();
                $mensajes[]="Se actualizo el token FCM.";
            }else{
                $tipo = ERROR;
                $mensajes[]="No se pudo encontrar el token";
            }
        }
        $data["mensajes"] = $mensajes;
        $data["tipo"] = $tipo;
        $data["data"] = $datos;
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


                    $proveedorList = Proveedor::getProveedorListParaBusqueda($busqueda);

                    foreach ($proveedorList as $cancha){
                        $cancha->totalCanchas = 1;
                    }


                    $datos = $proveedorList;


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
    
}
?>