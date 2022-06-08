<?php 
class ClienteController { 
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
    		$obj = new Cliente($obj);
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

    public function editar($id, $client)
    {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = null;

        $clientObj = new Cliente($client);
        $clienteDb = Cliente::getById($id);

        if(!$clienteDb){
            $tipo = ERROR;
            $mensajes[] = "El cliente no existe";
        }

        if(empty($mensajes)){
            if(is_null($clientObj->getCliente_telefono()) || empty($clientObj->getCliente_telefono())){
                $tipo = ERROR;
                $mensajes[] = "El numero de telefono es obligatorio.";
            }
        }

        if(empty($mensajes)){
            $tipo = ERROR;
            $mensajes = $clientObj->validarCantidadDigitosMobileByCode();
        }

        if(empty($mensajes)){
            $tipo = ERROR;
            $mensajes = $clientObj->validarMobileEnBD($clienteDb->getCliente_id());
        }


        if (empty($mensajes)) {

            if($clientObj->getCliente_telefono()){
                $clienteDb->setCliente_telefono($clientObj->getCliente_telefono());
            }
            if($clientObj->getCliente_nombres()){
                $clienteDb->setCliente_nombres($clientObj->getCliente_nombres());
            }
            if($clientObj->getCliente_apellidos()){
                $clienteDb->setCliente_apellidos($clientObj->getCliente_apellidos());
            }
            if($clientObj->getCliente_correo()){
                $clienteDb->setCliente_correo($clientObj->getCliente_correo());
            }
            if($clientObj->getCliente_tipocomprobante()){
                $clienteDb->setCliente_tipocomprobante($clientObj->getCliente_tipocomprobante());
            }
            if($clientObj->getCliente_numerodoc()){
                $clienteDb->setCliente_numerodoc($clientObj->getCliente_numerodoc());
            }
            if($clientObj->getCliente_razonsocial()){
                $clienteDb->setCliente_razonsocial($clientObj->getCliente_razonsocial());
            }
            if($clientObj->getCliente_direccion()){
                $clienteDb->setCliente_direccion($clientObj->getCliente_direccion());
            }

            $resultado = $clienteDb->update();
            if ($resultado) {
                $tipo = SUCCESS;
                $datos = $clienteDb;
                $mensajes[] = "Se modificó con éxito.";

                $datos->address = "";
                $datos->provincia = "";
                $addressDefault = Address::getDefault($datos->cliente_id);
                if($addressDefault){
                    $datos->address = $addressDefault->address_direccionusuario;
                    $datos->provincia = $addressDefault->address_distrito;
                }

            } else {
                $tipo = ERROR;
                $mensajes[] = "Se produjo un error al modificar. Intentalo de nuevo.";
            }
        }
        $data["mensajes"] = $mensajes;
        $data["tipo"] = $tipo;
        $data["data"] = $datos;
        return $data;
    }
    
    public function getById($id) {
    	$data = array();
    	$mensajes = array();
    	$tipo = SUCCESS;
    	$datos = Cliente::getById($id);
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
    	$obj = Cliente::getById($id);
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
      	$sqlWhere[] = array('field'=>'cliente_descripcion','value'=>$busqueda,'operator'=>'=');
      }
    	$array_salida = Cliente::getByFields($sqlWhere,array(),($pagina-1)*$registros,$registros);
    	$totalCount=$array_salida['totalCount'];
    	$array_salida=$array_salida['cliente_array'];
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
    	$array_salida = Cliente::getByFields(array(
    	array('field'=>'cliente_estado','value'=>'1','operator'=>'=')
    	));
    	$datos=$array_salida['cliente_array'];
    	$data['mensajes'] = $mensajes;
    	$data['tipo'] = $tipo;
    	$data['data'] = $datos;
    	return $data;
    }

    public function verificarToken($token)
    {
        $tipo = SUCCESS;
        $datos = array();
        $mensajes = array();
        $data = array();
        if (empty($mensajes)) {

            $client_id = Security::getClientIdByToken($token);
            if ($client_id == -1) {

                $tipo  =  ERROR;
                $mensajes[] = "Token no valido";

            }else{
                $tipo  =  SUCCESS;
                $mensajes[] = "Token valido";


            }

        }
        $data["mensajes"] = $mensajes;
        $data["tipo"] = $tipo;
        $data["data"] = $datos;
        return $data;
    }

    public function login($client){
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = array();
        $clienteLogueado = null;

        $clienteObj = new Cliente($client);

        if (empty($mensajes)) {


            $clienteObj->verificarCliente();

            $clienteLogueado = Cliente::iniciarSesionMultiple($clienteObj);

            if ($clienteLogueado) {

                if ($clienteLogueado->cliente_activado == SI) {

                    $clienteObj->cliente_id = $clienteLogueado->cliente_id;

                    $token = Token::generarToken($clienteObj);

                    //fin de token
                    $tipo = SUCCESS;
                    $mensajes[] = "Logueado con exito";
                    $datos["token"] = $token->token_valor;
                    $datos["cliente_nombres"] = $clienteLogueado->cliente_nombres;
                    $datos["cliente_apellidos"] = $clienteLogueado->cliente_apellidos;
                    $datos["cliente_id"] = $clienteLogueado->cliente_id;
                    $datos["cliente_telefono"] = $clienteLogueado->cliente_telefono;
                    $datos["client_esnuevo"] = $clienteObj->{'cliente_esnuevo'};


                }else{
                    $tipo = WARNING;
                    $mensajes[] = "Debe activar su cuenta";
                    $datos["cliente_id"] = $clienteLogueado->cliente_id;
                    $usuarioLogueado = null;
                }
            } else {
                $tipo = ERROR;
                $mensajes[] = "Usuario incorrecto";
                $datos["token"] = "";
                $usuarioLogueado = null;
            }
        }
        $data["mensajes"] = $mensajes;
        $data["tipo"] = $tipo;
        $data["data"] = $datos;
        return $data;
    }

    public function enviarCodigo($client_id,$type_send = TYPE_SEND_SMS){
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = "";
        $reenvio = "";
        if (empty($mensajes)) {

            $client = Cliente::getById($client_id);

            if($client){

                $client->setCliente_codigoactivo(rand(1000, 9999));
                $client->update();

                $tipo = SUCCESS;
                $datos = $client->cliente_id;
                if($type_send == TYPE_SEND_SMS){

                    if($client->getCliente_telefono()){
                        $reenvio = $this->enviarSMSConCodigoActivacion($client->cliente_id)["data"];
                        if(!$reenvio){
                            $tipo = ERROR;
                            $mensajes[] = "Se produjo un error enviando el sms";
                        }else{
                            $mensajes[] = "Reenvio con éxito.";
                        }
                    }else{
                        $tipo = ERROR;
                        $mensajes[] = "El numero de telefono no es validó.";
                    }


                }


            }else{

                $tipo = ERROR;
                $mensajes[] = "No se encontro el cliente";

            }
        }
        $data["mensajes"] = $mensajes;
        $data["tipo"] = $tipo;
        $data["data"] = $datos;
        $data["reenvio"] = $reenvio;
        return $data;
    }

    public function enviarSMSConCodigoActivacion($cliente_id){
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = false;
        $cliente = Cliente::getById($cliente_id);

        if($cliente->getCliente_telefono()){

            $activation_code = $cliente->getCliente_codigoactivo();

            $numero_telefono = $cliente->getCliente_telefono();

            if(!Utility::stringContiene($numero_telefono, "+")){
                $numero_telefono = "+51" . $numero_telefono;
            }


            $mensaje = 'Su codigo de verificacion para '.Utility::getTextoAPP().' es: ' . $activation_code . '. No comparta este codigo con nadie.';

            $datos = Utility::enviarSMS($numero_telefono, $mensaje);

        }




        $data["mensajes"] = $mensajes;
        $data["tipo"] = $tipo;
        $data["data"] = $datos;
        return $data;
    }

    public function validarCodigoActivacion($client_id, $activation_code){
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = null;
        $clientObj = Cliente::getById($client_id);
        if(!$clientObj){
            $tipo = ERROR;
            $mensajes[] = "Ningun registro encontrado";
        }
        if (empty($mensajes)) {

            if ($clientObj->getCliente_codigoactivo() == $activation_code) {
                $clientObj->setCliente_activado(SI);
                $clientObj->update();
                $datos = $clientObj->cliente_id;
                $tipo = SUCCESS;
                $mensajes[] = "Validación correcta";
            } else {
                $tipo = ERROR;
                $mensajes[] = "El codigo ingresado no es válido";
            }
        }
        $data["mensajes"] = $mensajes;
        $data["tipo"] = $tipo;
        $data["data"] = $datos;
        return $data;
    }

    public function updateFCM($item_array){
        $data = array();
        $tipo = SUCCESS;
        $mensajes = array();
        $datos = null;
        $clienteObj = Cliente::getById(Security::getCurrentClienteId());
        if(!$clienteObj){
            $tipo = ERROR;
            $mensajes[] = "Ningun registro encontrado";
        }
        if(!array_key_exists("token_fcm",$item_array)){
            $tipo = ERROR;
            $mensajes[] = "No ha enviado un token_fcm";
        }
        if(empty($mensajes)){
            $tokenObj = Security::getTokenObj();
            if($tokenObj){
                $tokenObj->setToken_fcm($item_array["token_fcm"]);
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

    public function getPerfil() {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = Cliente::getById(Security::getCurrentClienteId());
        if(!$datos){
            $mensajes[] = 'Error, Valor no Encontrado';
            $tipo = DANGER;
        }else{
            $datos->address = "";
            $datos->provincia = "";
            $addressDefault = Address::getDefault($datos->cliente_id);
            if($addressDefault){
                $datos->address = $addressDefault->address_direccionusuario;
                $datos->provincia = $addressDefault->address_distrito;
            }

            $datos->provincia = $datos->cliente_correo;
        }
        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }

    public function getUltimaReserva() {
        $data = array();
        $mensajes = array();
        $datos = null;
        $tipo = SUCCESS;
        $cliente = Cliente::getById(Security::getCurrentClienteId());
        if($cliente){

            $reservaList = Reserva::getUltimasReservasCliente($cliente->cliente_id);
            $reserva_salida = array();

            foreach ($reservaList as $reserva){
                $reserva_salida[] = $reserva->getInformacionReserva();
            }

            $datos = $reserva_salida;

        }else{
            $mensajes[] = 'Error, Valor no Encontrado';
            $tipo = DANGER;
        }
        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }

    public function getUltimaReservaConfirmada() {
        $data = array();
        $mensajes = array();
        $datos = null;
        $tipo = SUCCESS;
        $cliente = Cliente::getById(Security::getCurrentClienteId());
        if($cliente){

            $reservaLast = Reserva::getUltimaReservaClienteConfirmada($cliente->cliente_id);

            if($reservaLast){
                $datos = $reservaLast->getInformacionReserva();
            }

        }else{
            $mensajes[] = 'Error, Valor no Encontrado';
            $tipo = DANGER;
        }
        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }

    public function getReservaList($pagina, $registros, $obj) {
        $data = array();
        $mensajes = array();
        $datos = array();
        $tipo = SUCCESS;
        $totalCount = 0;


        /*if(Utility::fechaAesMayorFechab($obj->fechaFinal, Utility::getFechaActual())){
            $obj->fechaFinal = Utility::sumarRestarDias(Utility::getFechaHoraActual(), 1, "-");
        }*/

        $cliente = Cliente::getById(Security::getCurrentClienteId());
        if($cliente){

            $array_data = Reserva::getHistorialReservaCliente($cliente->cliente_id, $obj, $pagina, $registros);
            $datos = $array_data["reserva_array"];
            $totalCount = $array_data["totalCount"];


        }else{
            $mensajes[] = 'Error, Valor no Encontrado';
            $tipo = DANGER;
        }
        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        $data['totalregistros'] = $totalCount;
        return $data;
    }

    public function getDataReserva($reserva_id) {
        $data = array();
        $mensajes = array();
        $datos = array();
        $tipo = SUCCESS;
        $reserva = Reserva::getById($reserva_id);
        if($reserva){
            $datos = $reserva->getInformacionReserva();

        }else{
            $mensajes[] = 'No se encontro la reserva solicitada.';
            $tipo = DANGER;
        }
        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }
    
}
?>