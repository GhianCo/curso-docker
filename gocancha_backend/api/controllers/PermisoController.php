<?php 
class PermisoController { 
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
    		$obj = new Permiso($obj);
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
    		$obj=new Permiso($obj);
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
    	$datos = Permiso::getById($id);
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
    	$obj = Permiso::getById($id);
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
      	$sqlWhere[] = array('field'=>'permiso_descripcion','value'=>$busqueda,'operator'=>'=');
      }
    	$array_salida = Permiso::getByFields($sqlWhere,array(),($pagina-1)*$registros,$registros);
    	$totalCount=$array_salida['totalCount'];
    	$array_salida=$array_salida['permiso_array'];
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
    	$array_salida = Permiso::getByFields(array(
    	array('field'=>'permiso_estado','value'=>'1','operator'=>'=')
    	));
    	$datos=$array_salida['permiso_array'];
    	$data['mensajes'] = $mensajes;
    	$data['tipo'] = $tipo;
    	$data['data'] = $datos;
    	return $data;
    }

    public function getPermisos($usuario_id){

        $array_categoriaspadre = Permiso::getDistictCategoriasPadre();
        $array_categoriaspadre = $array_categoriaspadre["permiso_array"];
        $array_permisosouput = array();

        foreach ($array_categoriaspadre as $categoriapadre) {
            $permisoSTD=new stdClass();
            $array_permisosSueltas=Permiso::getPermisosSueltas($categoriapadre->getPermiso_categoriapadre(),$usuario_id);
            $array_permisosSueltas=$array_permisosSueltas["permiso_array"];
            $permisoSTD->permisos_sueltas=$array_permisosSueltas;

            $array_categorias=Permiso::getDistictCategorias($categoriapadre->getPermiso_categoriapadre());
            $array_categorias=$array_categorias["permiso_array"];

            $array_permisosHijos=array();
            foreach ($array_categorias as $value) {
                $permisoHijoSTD=new stdClass();
                $array_permisosHijas_axu=Permiso::getPermisosHijas($value->getPermiso_categoria(),$categoriapadre->getPermiso_categoriapadre(),$usuario_id);
                $permisoHijoSTD->hijos=$array_permisosHijas_axu["permiso_array"];
                $permisoHijoSTD->categoria=$value->permiso_categoria;
                $array_permisosHijos[]=$permisoHijoSTD;
            }
            $permisoSTD->categorias=$array_permisosHijos;
            $permisoSTD->padre=$categoriapadre->permiso_categoriapadre;
            $array_permisosouput[]=$permisoSTD;

        }


        return array("result_permisos"=>$array_permisosouput);
    }
    
}
?>