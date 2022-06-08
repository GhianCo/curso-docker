<?php 
class FacturacionController { 
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
    		$obj = new Facturacion($obj);
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
    		$obj=new Facturacion($obj);
    		$obj->facturacion_fechapago = Utility::getFechaHoraActual();
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
    	$datos = Facturacion::getById($id);
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
    	$obj = Facturacion::getById($id);
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

    public function generarFacturacionSistema(){

        $data = array();
        $mensajes = array();
        $array_proveedores = array();
        $tipo = SUCCESS;

        $fechaFin = "2022-02-27 23:59:59";
         //obtengo la ultima fecha de fact
        $array_salida = Facturacion::getByFields(array(),array(
            array("field"=>"facturacion_fechafin","order"=>"desc")
        ),0,1)['facturacion_array'];

        if(count($array_salida)>0){

            $fechaFin = $array_salida[0]->facturacion_fechafin;

        }

        $fechaFin = Utility::obtenerFechaConFormato($fechaFin, "Y-m-d");

        $fechaInicioNueva = Utility::sumarRestarDias($fechaFin, 1, "+")  ." 00:00:01";
        $fechaFinNueva = Utility::sumarRestarDias($fechaInicioNueva, 6, "+")  ." 23:59:59";

        if(Utility::fechaAesMayorFechab($fechaFinNueva, Utility::getFechaHoraActual())){

            $tipo = ERROR;
            $mensajes[] = "Facturacion ya generada";

        }else{

            $array_proveedores = Proveedor::getByFields(array(
                array("field"=>"proveedor_estado","value"=>"1","operator"=>"=")
            ))["proveedor_array"];

            foreach ($array_proveedores as $prov){

                $totalHoras = Reserva::totalHorasReservadas($fechaInicioNueva, $fechaFinNueva,$prov->proveedor_id, REST_TODOS, TIPO_RESERVA_APP);

                $array_pagos = Reserva::reporteIngresosProveedor($prov->proveedor_id, $fechaInicioNueva, $fechaFinNueva);

                $totalDevolucion = 0;

                foreach ($array_pagos as $pagos){
                    $totalDevolucion += $pagos->monto_totalrecibir;
                }

                $objFacturacion = new Facturacion();
                $objFacturacion->setProveedor_id($prov->proveedor_id);
                $objFacturacion->setFacturacion_estado(FACTURACION_PENDIENTE);
                $objFacturacion->setFacturacion_fechafin($fechaFinNueva);
                $objFacturacion->setFacturacion_fechainicio($fechaInicioNueva);
                $objFacturacion->setFacturacion_totalcomisiones($totalDevolucion);
                $objFacturacion->setFacturacion_totalreservas($totalHoras);
                $objFacturacion->insert();

                $mensajes[] = "Facturacion generada para el proveedor: ".$prov->proveedor_nombre . ", total: ".$totalDevolucion;

            }

        }

        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = count($array_proveedores);
        return $data;


    }
    
    public function listarPorPaginacion($pagina,$registros,$estado = SI) {

         $array_where = array();

         if($estado != PARAM_ESTADO_TODOS){
            $array_where[] = array("field"=>"facturacion_estado","value"=>$estado, "operator"=>"=");
         }

    	$array_salida = Facturacion::getByFields($array_where,array(),($pagina-1)*$registros,$registros);
    	$totalCount=$array_salida['totalCount'];
    	$array_salida=$array_salida['facturacion_array'];

    	foreach ($array_salida as $salida){

    	    $salida->proveedor = Proveedor::getById($salida->proveedor_id);

        }

    	return array('lista'=>$array_salida,'totalCount'=>$totalCount);
    }
    
    public function getAllActivos() {
    	$array_salida = Facturacion::getByFields(array(
    	array('field'=>'facturacion_estado','value'=>'1','operator'=>'=')
    	));
    	$array_salida=$array_salida['facturacion_array'];
    	return $array_salida;
    }
    
}
?>