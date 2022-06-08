<?php 
class CanchaprecioController { 
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
    		$obj = new Canchaprecio($obj);
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
    		$obj=new Canchaprecio($obj);
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
    	$datos = Canchaprecio::getById($id);
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
    	$obj = Canchaprecio::getById($id);
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
      	$sqlWhere[] = array('field'=>'canchaprecio_descripcion','value'=>$busqueda,'operator'=>'=');
      }
    	$array_salida = Canchaprecio::getByFields($sqlWhere,array(),($pagina-1)*$registros,$registros);
    	$totalCount=$array_salida['totalCount'];
    	$array_salida=$array_salida['canchaprecio_array'];
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
    	$array_salida = Canchaprecio::getByFields(array(
    	array('field'=>'canchaprecio_estado','value'=>'1','operator'=>'=')
    	));
    	$datos=$array_salida['canchaprecio_array'];
    	$data['mensajes'] = $mensajes;
    	$data['tipo'] = $tipo;
    	$data['data'] = $datos;
    	return $data;
    }
    
}
?>