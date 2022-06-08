<?php 
class LoginController { 
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
    		$obj = new Login($obj);
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
    		$obj=new Login($obj);
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
    	$datos = Login::getById($id);
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
    	$obj = Login::getById($id);
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
      	$sqlWhere[] = array('field'=>'login_descripcion','value'=>$busqueda,'operator'=>'=');
      }
    	$array_salida = Login::getByFields($sqlWhere,array(),($pagina-1)*$registros,$registros);
    	$totalCount=$array_salida['totalCount'];
    	$array_salida=$array_salida['login_array'];
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
    	$array_salida = Login::getByFields(array(
    	array('field'=>'login_estado','value'=>'1','operator'=>'=')
    	));
    	$datos=$array_salida['login_array'];
    	$data['mensajes'] = $mensajes;
    	$data['tipo'] = $tipo;
    	$data['data'] = $datos;
    	return $data;
    }

    public function login($login){
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = array();
        $usuarioProveedorLogueado = null;

        $loginObj = new Login($login);

        if (empty($mensajes)) {

            $usuarioProveedorLogueado = Login::iniciarSesion($loginObj);

            if ($usuarioProveedorLogueado) {

                $proveedorList = Loginproveedor::getProveedoresByUsuario($usuarioProveedorLogueado->login_id);

                if(sizeof($proveedorList)){

                    $loginObj->login_id = $usuarioProveedorLogueado->login_id;

                    $token = Tokenproveedor::generarToken($loginObj);

                    $tipo = SUCCESS;
                    $mensajes[] = "Logueado con exito";
                    $datos["token"] = $token->tokenproveedor_valor;
                    $datos["usuario_nombres"] = $usuarioProveedorLogueado->login_nombres;
                    $datos["usuario_apellidos"] = $usuarioProveedorLogueado->login_apellidos;
                    $datos["usuario_usuario"] = $usuarioProveedorLogueado->login_usuario;
                    $datos["login_id"] = $usuarioProveedorLogueado->login_id;
                    $datos["proveedorList"] = $proveedorList;


                }else{

                    $tipo = ERROR;
                    $mensajes[] = "El usuario que ingreso no tiene vinculado al menos un centro deportivo.";

                }




            } else {
                $tipo = ERROR;
                $mensajes[] = "Usuario incorrecto";
            }
        }
        $data["mensajes"] = $mensajes;
        $data["tipo"] = $tipo;
        $data["data"] = $datos;
        return $data;
    }
    
}
?>