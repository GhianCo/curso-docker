<?php
class ReservaController {
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
    		$obj = new Reserva($obj);
    		$resultado = $obj->insert();
    		if ($resultado) {
    			$tipo = SUCCESS;
    			$mensajes[] = 'Se agregó con éxito.';
    			$datos = $resultado;
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
    		$obj=new Reserva($obj);
    		$resultado = $obj->update();
    		if ($resultado) {
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
    	$datos = Reserva::getById($id);
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
    	$obj = Reserva::getById($id);
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

    public function listarPorPaginacion($busqueda,$pagina,$registros) {
    	$data = array();
    	$mensajes = array();
    	$tipo = SUCCESS;
      $sqlWhere = array();
      if($busqueda != REST_TODOS){
      	$sqlWhere[] = array('field'=>'reserva_descripcion','value'=>$busqueda,'operator'=>'=');
      }
    	$array_salida = Reserva::getByFields($sqlWhere,array(),($pagina-1)*$registros,$registros);
    	$totalCount=$array_salida['totalCount'];
    	$array_salida=$array_salida['reserva_array'];
    	$datos=$array_salida;
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
    	$array_salida = Reserva::getByFields(array(
    	array('field'=>'reserva_estado','value'=>'1','operator'=>'=')
    	));
    	$datos=$array_salida['reserva_array'];
    	$data['mensajes'] = $mensajes;
    	$data['tipo'] = $tipo;
    	$data['data'] = $datos;
    	return $data;
    }

    public function reservasPanelPaginado($pagina, $registros,$fechaReserva, $obj) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;

        $array_salida = Reserva::reservasPanelPaginado($pagina, $registros,$fechaReserva, $obj);
        $totalCount=$array_salida['totalCount'];
        $array_salida=$array_salida['reserva_array'];
        $datos=$array_salida;

        foreach ($datos as $reserva){
            $reserva->cancha_tipotext = Cancha::getTipoText($reserva->cancha_tipo);
            $reserva->cancha_sizetext = Cancha::getSizeText($reserva->cancha_size);
            $reserva->reserva_tipopagotext = Utility::getDescripcionTipoPagoTxt($reserva->reserva_tipopago);
            $reserva->reserva_estadotext = Utility::getEstadoReservaTxt($reserva->reserva_estado);
            $reserva->cliente_tipocomprobantetext = Utility::getTipoComprobanteTxt($reserva->cliente_tipocomprobante);
            if($reserva->reserva_tipo == TIPO_RESERVA_MANUAL){
                $reserva->cliente_nombres = $reserva->reserva_cliente;
                $reserva->cliente_apellidos = null;
                $reserva->cliente_telefono = $reserva->reserva_telefono;
            }
        }

        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        $data['totalregistros'] = $totalCount;
        return $data;
    }

    public function aprobar($reserva_id, $obj) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $reserva = Reserva::getById($reserva_id);

        if(!$reserva){
            $tipo = ERROR;
            $mensajes[] = "La reserva no existe.";
        }

        if(!isset($obj->reserva_pagocon)){
            $tipo = ERROR;
            $mensajes[] = "El monto con que pagó es obligatorio.";
        }

        if(empty($mensajes)){
            if($obj->reserva_pagocon > $reserva->reserva_total){
                $tipo = ERROR;
                $mensajes[] = "El monto ingresado no debe ser mayor al total de la reserva.";
            }elseif ($obj->reserva_pagocon < $reserva->reserva_pagocon){
                $tipo = ERROR;
                $mensajes[] = "El monto ingresado no debe ser menor al monto minimo de la reserva.";
            }
        }

        if (empty($mensajes)) {

            $reserva->reserva_pagocon = $obj->reserva_pagocon;
            $reserva->reserva_estado = APROBADA;

            $resultado = $reserva->update();
            if ($resultado) {
                $tipo = SUCCESS;
                $mensajes[] = 'Se aprobó la reserva.';

                $reserva->actualizarMontoPago();

                $reserva->enviarNotificacion("Hola, tu reserva fue aprobada!",
                    "");

                $mensajeProveedor = "Nueva reserva para el ".Utility::getFechaSegunFormato($reserva->reserva_fechaprogramacion, "d/m")." a las ".Utility::getFechaSegunFormato($reserva->reserva_horainicio,"H:i");

                $reserva->enviarNotificacionProveedor($mensajeProveedor,"");

            } else {
                $tipo = DANGER;
                $mensajes[] = 'Se produjo un error al aprobar. Inténtalo de nuevo.';
            }
        }
        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        return $data;
    }

    public function rechazar($reserva_id, $obj) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $reserva = Reserva::getById($reserva_id);

        if(!$reserva){
            $tipo = ERROR;
            $mensajes[] = "La reserva no existe.";
        }

        if(!isset($obj->reserva_motivorechazo)){
            $tipo = ERROR;
            $mensajes[] = "El motivo de rechazó es obligatorio.";
        }

        if($reserva->reserva_estado == FINALIZADA){
            $tipo = ERROR;
            $mensajes[] = "La reserva no puede ser cancelada porque ya se encuentra finalizada.";
        }

        if (empty($mensajes)) {

            if($reserva->getReserva_estado() == PENDIENTE_CONFIRMAR_PAGO){
                $array_pagoss = Reservapago::getByFields(array(
                    array("field"=>"reserva_id", "value"=>$reserva->getReserva_id(), "operator"=>"=")
                ))["reservapago_array"];

                foreach ($array_pagoss as $pag){
                    $pag->delete();
                }
            }

            $reserva->reserva_motivorechazo = $obj->reserva_motivorechazo;
            $reserva->reserva_estado = CANCELADO;

            $resultado = $reserva->update();
            if ($resultado) {
                $tipo = SUCCESS;
                $mensajes[] = 'Se rechazó la reserva.';

                $reserva->enviarNotificacion("Lo sentimos, tu reserva fue rechazada",
                    $reserva->reserva_motivorechazo);
            } else {
                $tipo = DANGER;
                $mensajes[] = 'Se produjo un error al rechazar. Inténtalo de nuevo.';
            }
        }
        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        return $data;
    }

    public function registrar($cancha_id, $obj) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = null;

        $cancha = Cancha::getById($cancha_id);

        if(!$cancha){
            $mensajes[] = "La cancha seleccionada no fue encontrada.";
        }

        if(empty($mensajes)){
            $mensajes =  Reserva::validarReserva($obj, $cancha->cancha_id, $cancha->proveedor_id);
        }

        if(empty($mensajes)){
            if(Reserva::validacionDeDuplicacion($obj)){
                $mensajes[] = "Esta reserva posiblemente ya se encuentra registrada";
            }
        }

        if (empty($mensajes)) {


            $objReservaRegistrar  =  Reserva::armarReserva($obj, $cancha);

            $reserva = new Reserva(get_object_vars($objReservaRegistrar->reserva));
            $reserva->cancha_id = $cancha->cancha_id;
            $reserva->crear($objReservaRegistrar, $cancha->proveedor_id);


            if ($reserva->reserva_id > 0) {

                $reserva->registrarPago($reserva->reserva_pagocon, $reserva->reserva_tipopago);

                $reserva->dataNotificacionProveedor();

                $tipo = SUCCESS;
                $mensajes[] = 'Se agregó tu reserva.';
                $datos = Reserva::getById($reserva->reserva_id);
            } else{

                $mensajes[] = "Ocurrio un problema al crear la reserva, por favor intentalo nuevamente";
                $tipo  = ERROR;

            }
        } else {
            $tipo = ERROR;
        }
        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }

    public function registrarManual($cancha_id, $obj) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = null;

        $cancha = Cancha::getById($cancha_id);

        if(!$cancha){
            $mensajes[] = "La cancha seleccionada no fue encontrada.";
        }

        if(empty($mensajes)){
            $mensajes =  Reserva::validarReservaManual($obj, $cancha->cancha_id);
        }

        if(empty($mensajes)){
            if(Reserva::validacionDeDuplicacionManual($obj)){
                $mensajes[] = "Esta reserva posiblemente ya se encuentra registrada.";
            }
        }

        if (empty($mensajes)) {


            $objReservaRegistrar  =  Reserva::armarReservaManual($obj);

            $reserva = new Reserva(get_object_vars($objReservaRegistrar->reserva));
            $reserva->cancha_id = $cancha->cancha_id;
            $reserva->crearManual($cancha->proveedor_id);


            if ($reserva->reserva_id > 0) {

                $reserva->registrarPago($reserva->reserva_pagocon, $reserva->reserva_tipopago);

                $tipo = SUCCESS;
                $mensajes[] = 'Se agregó tu reserva.';
                $datos = $reserva;
            } else{

                $mensajes[] = "Ocurrio un problema al crear la reserva, por favor intentalo nuevamente";
                $tipo  = ERROR;

            }
        } else {
            $tipo = ERROR;
        }
        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }

    public function dataDashboard($obj) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = null;

        $fechaReserva = NO;

        $fechaInicio = isset($obj->fechainicio) ? $obj->fechainicio : Utility::getFechaActual() . " " . HORA_INICIO_FECHA; ;
        $fechaFin = isset($obj->fechafin) ? $obj->fechafin : Utility::getFechaActual() . " " . HORA_FIN_FECHA; ;


        if (empty($mensajes)) {

            $objDashboard = new stdClass();
            $objDashboard->ingreso_total = Reserva::totalReservasByFecha($fechaInicio, $fechaFin, $fechaReserva);
            $objDashboard->ingreso_totalcomision = Reserva::totalComisionByFecha($fechaInicio, $fechaFin, $fechaReserva);
            $objDashboard->ingreso_pagogocancha = Reserva::totalPagoPagarProveedorByFecha($fechaInicio, $fechaFin, PARAM_ESTADO_TODOS, PARAM_ESTADO_TODOS, TIPO_RESERVA_APP, $fechaReserva);
            $objDashboard->total_usuarios = Cliente::totalUsuariosActivos();
            $objDashboard->total_reservas = Reserva::cantidadTotaReservasByFecha($fechaInicio, $fechaFin, REST_TODOS, REST_TODOS, $fechaReserva);
            $objDashboard->total_horasreservas = Reserva::totalHorasReservadas($fechaInicio, $fechaFin, REST_TODOS, REST_TODOS, REST_TODOS, $fechaReserva);
            $objDashboard->total_reservascanceladas = Reserva::cantidadTotaReservasCanceladasByFecha($fechaInicio, $fechaFin, REST_TODOS, REST_TODOS, false, $fechaReserva);
            $objDashboard->ticket_promedio = Utility::divideTwoNumbers($objDashboard->ingreso_total, $objDashboard->total_reservas);
            $objDashboard->fechaInicio = $fechaInicio;
            $objDashboard->fechaFin = $fechaFin;

            $objDashboard->tipopagoList = Utility::getTiposPagoList();

            foreach ($objDashboard->tipopagoList as $tipopago){
                $tipopago->tipopago_total = Reserva::totalReservasByFechaTipoPago($fechaInicio, $fechaFin, $tipopago->tipopago_id, $fechaReserva);
                $tipopago->tipopago_porcentaje = Utility::divideTwoNumbers($tipopago->tipopago_total, $objDashboard->ingreso_pagogocancha) * 100;

                $tipopago->tipopago_total_comision = Reserva::totalComisionesReservasByFechaTipoPago($fechaInicio, $fechaFin, $tipopago->tipopago_id, $fechaReserva);
                $tipopago->tipopago_porcentaje_comision = Utility::divideTwoNumbers($tipopago->tipopago_total_comision, $objDashboard->ingreso_totalcomision) * 100;
            }

            $objDashboard->deporteList = Deporte::getDeporteListHome();
            $objDashboard->deporteHorasList = Deporte::getDeporteListHome();

            $objDashboard->proveedorList = Reserva::getTopProveedor($fechaInicio, $fechaFin, 5, $fechaReserva);
            $objDashboard->proveedorList_comision = Reserva::getTopComisionProveedor($fechaInicio, $fechaFin, 5, $fechaReserva);

            foreach ($objDashboard->deporteList as $deporte){
                $deporte->deporte_total = Reserva::totalReservasByFechaDeporte($fechaInicio, $fechaFin, $deporte->deporte_id, $fechaReserva);
                $deporte->deporte_porcentaje = Utility::divideTwoNumbers($deporte->deporte_total, $objDashboard->ingreso_pagogocancha) * 100;

                $deporte->deporte_total_comision = Reserva::totalComisionesByFechaDeporte($fechaInicio, $fechaFin, $deporte->deporte_id, $fechaReserva);
                $deporte->deporte_porcentaje_comision = Utility::divideTwoNumbers($deporte->deporte_total_comision, $objDashboard->ingreso_totalcomision) * 100;
            }

            foreach ($objDashboard->deporteHorasList as $deporte){
                $deporte->deporte_totalhoras = Reserva::totalHorasReservadasByDeporte($fechaInicio, $fechaFin, $deporte->deporte_id, $fechaReserva);
                $deporte->deporte_porcentaje = Utility::divideTwoNumbers($deporte->deporte_totalhoras, $objDashboard->total_horasreservas) * 100;
            }

            foreach ($objDashboard->proveedorList as $proveedor){
                $proveedor->proveedor_porcentaje = Utility::divideTwoNumbers($proveedor->proveedor_total, $objDashboard->ingreso_pagogocancha) * 100;
            }

            foreach ($objDashboard->proveedorList_comision as $proveedor){
                $proveedor->proveedor_porcentaje = Utility::divideTwoNumbers($proveedor->proveedor_total, $objDashboard->ingreso_totalcomision) * 100;
            }


            $objDashboard->graficoReservasDia = Reserva::getGraficoReservasDias($fechaInicio, $fechaFin, $fechaReserva);

            $datos = $objDashboard;

        }
        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }

    public function cancelar($reserva_id, $obj) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $notifico = false;
        $reserva = Reserva::getById($reserva_id);

        if(!$reserva){
            $tipo = ERROR;
            $mensajes[] = "La reserva no existe.";
        }

        /*if(!isset($obj->reserva_motivorechazo)){
            $tipo = ERROR;
            $mensajes[] = "El motivo de rechazó es obligatorio.";
        }*/

        if (empty($mensajes)) {

            if($reserva->getReserva_estado() == PENDIENTE_CONFIRMAR_PAGO){
                $array_pagoss = Reservapago::getByFields(array(
                    array("field"=>"reserva_id", "value"=>$reserva->getReserva_id(), "operator"=>"=")
                ))["reservapago_array"];

                foreach ($array_pagoss as $pag){
                    $pag->delete();
                }
            }

            if(isset($obj->reserva_motivorechazo)){
                $reserva->reserva_motivorechazo = $obj->reserva_motivorechazo;
            }
            $reserva->reserva_estado = CANCELADO;

            $resultado = $reserva->update();
            if ($resultado) {
                $tipo = SUCCESS;
                $mensajes[] = 'Se canceló tu reserva.';

                if($reserva->reserva_tipopago == PAGO_ENLINEA){
                    $reserva->devolverPagoEnLineaNiubiz();
                }

                $notifico = $reserva->enviarNotificacion("Lo sentimos, tu reserva fue rechazada", $reserva->reserva_motivorechazo);
            } else {
                $tipo = DANGER;
                $mensajes[] = 'Se produjo un error al rechazar. Inténtalo de nuevo.';
            }
        }
        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['datos'] = $reserva;
        $data['notifico'] = $notifico;
        return $data;
    }

    public function cabeceraIngresos($fechaInicio, $fechaFin) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = null;



        if (empty($mensajes)) {

            $objDashboard = new stdClass();
            $objDashboard->ingreso_total = Reserva::totalPagoPagarProveedorByFecha($fechaInicio, $fechaFin, PARAM_ESTADO_TODOS, PARAM_ESTADO_TODOS, TIPO_RESERVA_APP);

            $objDashboard->egreso_total = Reserva::totalPagoEgresosByFecha($fechaInicio, $fechaFin, PARAM_ESTADO_TODOS, PARAM_ESTADO_TODOS, false);


            $objDashboard->comisiones = Reserva::totalPagoComisionesByFecha($fechaInicio, $fechaFin, PARAM_ESTADO_TODOS, PARAM_ESTADO_TODOS, TIPO_RESERVA_APP);

            $objDashboard->tipopagoList = Utility::getTiposPagoList();

            /*foreach ($objDashboard->tipopagoList as $tipopago){
                $tipopago->tipopago_total = Reserva::totalPagoIngresosByFechaTipoPago($fechaInicio, $fechaFin, $tipopago->tipopago_id);
            }*/

            $totalApp = 0;
            foreach ($objDashboard->tipopagoList as $tipopago){

                if($tipopago->tipopago_id == PAGO_APP){

                    $tipopago->tipopago_total = $tipopago->tipopago_total + Reserva::totalPagoIngresosByFechaTipoPago($fechaInicio, $fechaFin, $tipopago->tipopago_id, PARAM_TODOS, PARAM_ESTADO_TODOS , TIPO_RESERVA_APP, true);

                }else{

                    $tipopago->tipopago_total = Reserva::totalPagoIngresosByFechaTipoPago($fechaInicio, $fechaFin, $tipopago->tipopago_id, PARAM_TODOS, PARAM_ESTADO_TODOS , TIPO_RESERVA_APP, true);

                }
            }

            if(!is_numeric($objDashboard->ingreso_total)) $objDashboard->ingreso_total = 0;
            if(!is_numeric($objDashboard->egreso_total)) $objDashboard->egreso_total = 0;

            $objDashboard->saldo_total = $objDashboard->ingreso_total - $objDashboard->comisiones + $objDashboard->egreso_total;

            $objDashboard->total_pagar_proveedor = $objDashboard->ingreso_total - $objDashboard->comisiones;

            $datos = $objDashboard;

        }
        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }

    public function reporteIngresosEgresos($fechaInicio, $fechaFin,$pagina,$registros, $estado = PARAM_TODOS) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;

        $array_salida = Reserva::reporteIngresosEgresos($fechaInicio, $fechaFin,$pagina,$registros, $estado);
        $totalCount=$array_salida['totalCount'];
        $array_salida=$array_salida['reserva_array'];

        $datos=$array_salida;
        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        $data['totalregistros'] = $totalCount;
        return $data;
    }


    public function reporteUsuarios($fechaInicio, $fechaFin,$pagina,$registros, $estado = PARAM_TODOS) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;

        $array_salida = Cliente::reporteUsuarios($fechaInicio, $fechaFin,$pagina,$registros, $estado);
        $totalCount=$array_salida['totalCount'];
        $array_salida=$array_salida['cliente_array'];

        $datos=$array_salida;
        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        $data['totalregistros'] = $totalCount;
        return $data;
    }

    public function reporteUsuariosActivosInactivosPorProveedor($fechaInicio, $fechaFin,$pagina,$registros, $estado = PARAM_TODOS, $proveedor_id) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;

        $array_salida = Cliente::reporteUsuariosActivosInactivosPorProveedor($fechaInicio, $fechaFin,$pagina,$registros, $estado, $proveedor_id);
        $totalCount=$array_salida['totalCount'];
        $array_salida=$array_salida['cliente_array'];

        $datos=$array_salida;
        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        $data['totalregistros'] = $totalCount;
        return $data;
    }

    public function cabeceraCanchas($fechaInicio, $fechaFin) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = null;



        if (empty($mensajes)) {

            $objDashboard = new stdClass();
            $objDashboard->total_horasreservas = Reserva::totalHorasReservadas($fechaInicio, $fechaFin);
            $objDashboard->horario_maspedido = Reserva::getHorarioMasPedido($fechaInicio, $fechaFin);
            $objDashboard->horario_menospedido = Reserva::getHorarioMenosPedido($fechaInicio, $fechaFin);
            $objDashboard->deporteList = Deporte::getDeporteListHome();
            $objDashboard->proveedorList = Reserva::getProveedorReservaByFecha($fechaInicio, $fechaFin);

            foreach ($objDashboard->deporteList as $deporte){
                $deporte->deporte_cantidadtotal = Reserva::cantidadReservasByFechaDeporte($fechaInicio, $fechaFin, $deporte->deporte_id);
            }

            usort($objDashboard->deporteList, Utility::sort('deporte_cantidadtotal','DESC'));


            $datos = $objDashboard;

        }
        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }

    public function reporteCancha($fechaInicio, $fechaFin,$pagina,$registros) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;

        $array_salida = Reserva::reporteCancha($fechaInicio, $fechaFin,$pagina,$registros);
        $totalCount=$array_salida['totalCount'];
        $array_salida=$array_salida['reserva_array'];

        $datos=$array_salida;
        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        $data['totalregistros'] = $totalCount;
        return $data;
    }

    public function getFiltrosReserva() {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;


        $objSalida = new stdClass();
        //$objSalida->deporteList = Deporte::getDeporteListHome();
        $objSalida->deporteList = Deporte::getDeporteListPorProveedor();
        $objSalida->sizeList = Cancha::getSizes();
        $objSalida->estadoList = Reserva::getEstados();
        $objSalida->canalList = Utility::getCanalesReserva(CANAL_RESERVA_APP);
        $datos = $objSalida;


        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }

    public function reservaListProveedor($proveedor_id, $pagina, $registros, $obj) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;

        $array_salida = Reserva::reservaListProveedorPaginado($proveedor_id, $pagina, $registros, $obj);
        $totalCount=$array_salida['totalCount'];
        $array_salida=$array_salida['reserva_array'];
        $datos=$array_salida;

        foreach ($datos as $reserva){
            $reserva->cancha_sizetext = Cancha::getSizeText($reserva->cancha_size);
            $reserva->reserva_tipopagotext = Utility::getDescripcionTipoPagoTxt($reserva->reserva_tipopago);
            $reserva->reserva_estadotext = Utility::getEstadoReservaTxt($reserva->reserva_estado);
            $reserva->reserva_tipotext = Utility::getTipoReservaTxt($reserva->reserva_tipo);
            $reserva->reserva_nombrecliente = $reserva->reserva_tipo ==TIPO_RESERVA_APP ? $reserva->cliente_nombres . " " . $reserva->cliente_apellidos : $reserva->reserva_cliente;
            $reserva->reserva_telefonocliente = $reserva->reserva_tipo ==TIPO_RESERVA_APP ? $reserva->cliente_telefono : $reserva->reserva_telefono;
        }

        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        $data['totalregistros'] = $totalCount;
        return $data;
    }

    public function getDataSessionNiubiz($obj) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = null;


        if(!isset($obj->channel)){
            $tipo = ERROR;
            $mensajes[] = "Error en los parametros enviados.";
        }

        if(!isset($obj->amount)){
            $tipo = ERROR;
            $mensajes[] = "Error en los parametros enviados.";
        }

        if(empty($mensajes)){

            $tokenNiubiz = Reserva::getTokenNiubiz();
            $sessionNiubiz = Reserva::getSessionNiubiz($tokenNiubiz, $obj->channel, $obj->amount);

            if (isset($sessionNiubiz->sessionKey)) {
                $sessionNiubiz->channel = 'web';
                $sessionNiubiz->merchantid = MERCHANTID_NIUBIZ;
                $sessionNiubiz->purchasenumber = Utility::getUniqueChecksum();
                $sessionNiubiz->amount = $obj->amount;
                $sessionNiubiz->language = 'es';
                $sessionNiubiz->font = 'https://fonts.googleapis.com/css?family=Montserrat:400&display=swap';
            }

            $datos = $sessionNiubiz;

        }


        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;

        return $data;
    }

    public function ecommerceNiubiz($obj) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = null;



        if(!isset($obj->amount) || !isset($obj->cardNumber) || !isset($obj->expirationMonth) || !isset($obj->expirationYear) || !isset($obj->cvv2)
            || !isset($obj->firstName) || !isset($obj->lastName) || !isset($obj->email)){
            $tipo = ERROR;
            $mensajes[] = "Error en los parametros enviados.";
        }


        if(empty($mensajes)){

            $tokenNiubiz = Reserva::getTokenNiubiz();
            $objFormateadoCommerce = Utility::getObjEcommerceNiubizFormated($obj);
            $dataEcommerceNiubiz = Reserva::crearEcommerceNiubiz($tokenNiubiz, $objFormateadoCommerce);

            return $dataEcommerceNiubiz;

        }


        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;

        return $data;
    }

    public function finalizar($obj) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = null;

        if(empty($mensajes)){

            // uso el mismo metodo para cancelar
            if(isset($obj->tipo) && $obj->tipo == "cancelar"){

                $obj->reserva_motivorechazo = "Cancelado por el proveedor";
                $dataTem = $this->cancelar($obj->reserva_id, $obj);

                $data['mensajes'] = $dataTem["mensajes"];
                $data['tipo'] = $dataTem["tipo"];
                $data['data'] = $dataTem["datos"];
                $data['notifico'] = $dataTem["notifico"];

                return $data;

            }else{

                if(!isset($obj->reserva_id) || !isset($obj->reserva_pagocon) || !isset($obj->reserva_tipopago)){
                    $tipo = ERROR;
                    $mensajes[] = "Error en los parametros enviados.";
                }

            }
        }

        if(empty($mensajes)){
            $reserva = Reserva::getById($obj->reserva_id);

            if(!$reserva){
                $tipo = ERROR;
                $mensajes[] = "No se encontro la reserva solicitada.";
            }
        }

        /*if(empty($mensajes)){
            if(isset($obj->reserva_tipopago) && $obj->reserva_tipopago == PAGO_DEPOSITO && isset($obj->reserva_tipopag)){

            }
        }*/

        if(empty($mensajes)){
            if($reserva->reserva_estado == FINALIZADA){
                $tipo = ERROR;
                $mensajes[] = "La reserva ya ha sido finalizada.";
            }
        }

        if(empty($mensajes)){
            $montoFaltante = Reserva::getMontoFaltanteReserva($reserva->reserva_id);

            if($montoFaltante != $obj->reserva_pagocon){
                $tipo = ERROR;
                $mensajes[] = "El monto faltante es de " . $montoFaltante;
            }
        }

        if($obj->reserva_tipopago == PAGO_DEPOSITO){
            // no se puede
            $tipo = ERROR;
            $mensajes[] = "Seleccione un medio de pago";
        }



        if(empty($mensajes)){

            $reserva->reserva_estado = FINALIZADA;

            $reserva->update();

            $reserva->registrarPago($obj->reserva_pagocon, $obj->reserva_tipopago);

            $mensajes[] = "Se finalizó la reserva";

            $datos = $reserva;
        }


        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;

        return $data;
    }

    public function inactivarByProveedor($cliente_id, $proveedor_id) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $cliente = Cliente::getById($cliente_id);

        if(!$cliente){
            $tipo = ERROR;
            $mensajes[] = "El cliente no existe.";
        }


        if (empty($mensajes)) {

            if(!Clienteproveedor::clienteInactivoProveedor($cliente_id, $proveedor_id)){
                $obj = new Clienteproveedor();
                $obj->cliente_id = $cliente_id;
                $obj->proveedor_id = $proveedor_id;
                $obj->insert();
                $tipo = SUCCESS;
                $mensajes[] = 'Se inactivo el cliente.';
                $cliente->cliente_estado = PARAM_ESTADO_INACTIVO;
            }else{
                $tipo = ERROR;
                $mensajes[] = 'El cliente ya se encuentra inactivo.';
            }


        }
        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $cliente;
        return $data;
    }

    public function activarByProveedor($cliente_id, $proveedor_id) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $cliente = Cliente::getById($cliente_id);

        if(!$cliente){
            $tipo = ERROR;
            $mensajes[] = "El cliente no existe.";
        }


        if (empty($mensajes)) {

            if(Clienteproveedor::clienteInactivoProveedor($cliente_id, $proveedor_id)){

                Clienteproveedor::eliminarClienteProveedor($cliente_id, $proveedor_id);

                $tipo = SUCCESS;
                $mensajes[] = 'Se activo el cliente.';

                $cliente->cliente_estado = PARAM_ESTADO_ACTIVO;

            }else{
                $tipo = ERROR;
                $mensajes[] = 'El cliente ya se encuentra activo con este proveedor.';
            }


        }
        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $cliente;
        return $data;
    }

    public function getCanalesReservaManual() {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = null;


        if(empty($mensajes)){

            $datos = Utility::getCanalesReserva(CANAL_RESERVA_APP);

        }


        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;

        return $data;
    }


    public function notificarReservaProxima() {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = null;


        if(empty($mensajes)){
            $fechaActual = Utility::getFechaHoraActual();
            $reservaList = Reserva::getReservasProximaFecha($fechaActual);

            foreach ($reservaList as $reserva){

                $objProveedor = Proveedor::getById($reserva->proveedor_id);

                $proveedor = "";
                if($objProveedor){
                    $proveedor = $objProveedor->getProveedor_nombre();
                }

                $hora_formateada = Utility::getFechaSegunFormato($reserva->reserva_horainicio,"H:i");
                $reserva->enviarNotificacion("Tu reserva está por comenzar",
                    $proveedor.": Tienes una reserva con nosotros a las $hora_formateada");
            }

            $datos = $reservaList;

        }


        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;

        return $data;
    }

    public function testNotificacionCliente($id) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = null;

        $array_dispositivos_android = Token::obtenerTokenDispositivosAndroid($id, null);
        $array_dispositivos_ios = Token::obtenerTokenDispositivosiOS($id, null);

        $dataNot = array(
            "message" => "Text",
            "messageBig" => "Text big",
            "notificationId" => 1,
            "requireLogin" => SI,
            "notificationType" => NOTIFICATION_CHANGE_STATE,
        );

        APS::enviarNotificacion($dataNot, $array_dispositivos_ios, NO);
        FCM::enviarNotificacion($dataNot, $array_dispositivos_android, NO);


        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['id'] = $id;
        $data['data'] = $array_dispositivos_android;
        $data['data2'] = $array_dispositivos_ios;

        return $data;
    }

    public function testNotificacionProveedor($id) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = null;


        $array_dispositivos_android = Tokenproveedor::obtenerTokenDispositivosAndroid($id, null);
        $array_dispositivos_ios = Tokenproveedor::obtenerTokenDispositivosiOS($id, null);

        $dataNot = array(
            "message" => "Text",
            "messageBig" => "Text big",
            "notificationId" => 1,
            "requireLogin" => SI,
            "notificationType" => NOTIFICATION_CHANGE_STATE,
        );

        APS::enviarNotificacion($dataNot, $array_dispositivos_ios, SI);
        FCM::enviarNotificacion($dataNot, $array_dispositivos_android, SI);


        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['id'] = $id;
        $data['data'] = $array_dispositivos_android;
        $data['data2'] = $array_dispositivos_ios;

        return $data;
    }

}
?>