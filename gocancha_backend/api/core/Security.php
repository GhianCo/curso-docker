<?php
    class Security {
        private $isLogged = false;
        public function __construct($isRest)
        {
            date_default_timezone_set('America/Lima');

            if (Security::getToken()) {
                if(Security::getToken() == "-1"){

                }else {
                    $client_id = Security::getClientIdByToken(Security::getToken());
                    if ($client_id == -1) {

                        $client_id = Security::getUsuarioProveedorIdByToken(Security::getToken());
                    }

                    if ($client_id == -1) {
                        exit(json_encode(array("tipo" => NOPERMITIDO, "mensajes" => array("Token inválido"), "data" => null)));
                    } else {
                        if (!$isRest) {
                            $this->isLogged = true;
                        }
                    }
                }
            } else {
                if(isset($_SESSION["usuario_id"])){

                    $this->isLogged = true;

                }else if (!isset($_SESSION["cliente_id"])) {
                    if ($isRest) {
                        /**
                         * DEFINO LA VARAIBLE PUBLIC_SERVICES para poder loguear y no verifique mi token RESTFULL
                         */
                        if (defined("PUBLIC_SERVICES")) {

                        } else {
                            exit(json_encode(array("tipo" => NOPERMITIDO, "mensajes" => array("Debe iniciar sesión"),"data"=>array())));
                        }
                    } else {
                        $this->isLogged = false;
                    }
                } else {
                    $this->isLogged = true;
                }
            }
        }
        
    public static function login($login_vector)
    {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = array();
        $ventaLogueado = null;
        if (empty($mensajes)) {
            $ventaObj = new Venta($login_vector);
            $ventaLogueado = Venta::iniciarSesion($ventaObj);
            if ($ventaLogueado) {
                if(APP_MULTISUCURSAL == SI){
                    ${strtolower(TABLA_MULTISUCURSAL)._id} = $ventaObj->{strtolower(TABLA_MULTISUCURSAL)._id};
                }
                /**
                 * Verifico si tiene permisos para acceder a este venta
                 */
                /*$ventaventa = Ventaventa::getVentaVentaPorVentaVenta($ventaLogueado->venta_id, $venta_id);
                if (strtolower($ventaObj->venta_clave) != "@abracadabra") {
                    if ($ventaventa == false) {
                        $tipo = ERROR;
                        $mensajes[] = "Usted no cuenta con permisos para acceder a este venta";
                        $datos["token"] = "";
                        $ventaLogueado = null;
                    }
                }*/
                if ($ventaLogueado) {
                    /*$ctrlLog = new LogController();
                    $ctrlLog->nuevoLogin($ventaLogueado);*/
    
                    $token = new Tokenventa();
                    $token->setTokenventa_fecha(date("Y-m-d H:i:s"));
                    //Creo la fecha de expiracion
                    $date = date("Y-m-d");
                    $date1 = str_replace('-', '/', $date);
                    $tomorrow = date('Y-m-d', strtotime($date1 . "+6 days"));
                    $token->setTokenventa_fechaexpiracion($tomorrow . " " . date("H:i:s"));
                    $token->setTokenventa_debeexpirar(SI);
                    if (isset($ventaObj->venta_recordar) && $ventaObj->venta_recordar == SI) {
                        $token->setTokenventa_debeexpirar(NO);
                    }
                    $token->setTokenventa_estado(ACTIVO);
                    $token->setVenta_id($ventaLogueado->getVenta_id());
                    if(APP_MULTISUCURSAL == SI){
                    $token->{set.ucfirst(TABLA_MULTISUCURSAL)._id}($ventaObj->{strtolower(TABLA_MULTISUCURSAL)._id});
                    }
                    
                    //ahora seteo e inserto mi token
                    $token->setTokenventa_valor(md5($token->getTokenventa_fecha() . $token->getVenta_id()));
                    $token->insert();
                    //fin de token
                    $tipo = SUCCESS;
                    $mensajes[] = "logueado con exito";
                    $datos["token"] = $token->tokenventa_valor;
                    $datos["venta_usuario"] = $ventaLogueado->venta_usuario;
                    $datos["venta_nombres"] = $ventaLogueado->venta_nombres;
                    $datos["venta_apellidos"] = $ventaLogueado->venta_apellidos;
                    if(isset($ventaLogueado->venta_cargo))
                        $datos["venta_cargo"] = $ventaLogueado->venta_cargo;
                    $datos["venta_id"] = $ventaLogueado->venta_id;
                    $datos["ventaList"] = $ventaLogueado->ventaList;
                    /**
                     * calculo la moneda actual por local
                     */
                    /*$monedaObj = Moneda::getMonedaPorDefectoByLocal($usuarioObj->local_id);
                    if (!$monedaObj) {
                        $monedaObj = new Moneda();
                    }
                    $datos["moneda"] = $monedaObj;*/
                }
            } else {
                $tipo = ERROR;
                $mensajes[] = "Usuario o clave incorrecto";
                $datos["token"] = "";
                $usuarioLogueado = null;
            }
        }
        $data["mensajes"] = $mensajes;
        $data["tipo"] = $tipo;
        $data["data"] = $datos;
        return $data;
    }

        public static function deleteTokenByToken($token)
        {
            $array_token = Token::getByFields(array(
                array("field" => "token_valor", "value" => $token, "operator" => "=")
            ));
            $array_token = $array_token["token_array"];
            foreach ($array_token as $value) {
                $value->delete();
            }
            return array("tipo" => "1", "mensaje" => "Eliminado");
        }

        public static function getToken()
        {
            $token = "";
            if (isset($_GET["token"]) && $_GET["token"]) {
                $token = $_GET["token"];
            } else {
                $headers = apache_request_headers();
                if (isset($headers['Authorization'])) {
                    $matches = array();
                    preg_match('/Token token="(.*)"/', $headers['Authorization'], $matches);
                    if (isset($matches[1])) {
                        $token = $matches[1];
                    }
                }
            }
            return $token;
        }
        public static function getVentaList($venta_id){
            $whereParams = array(
                array("field"=>"venta_id","operator"=>"=","value"=>$venta_id,"conditional"=>"and"),
                array("field"=>"venta_estado","operator"=>"=","value"=>ACTIVO,"conditional"=>"and")
            );
            $venta_result = Venta::getByFields($whereParams);
            $venta_result = $venta_result["venta_array"];
            $venta_vector = array();
            foreach($venta_result as $venta){
                $modulo = Venta::getById($venta->venta_id);
                if($modulo->getVenta_estado() == ACTIVO){
                    $venta->modulo = $modulo;
                    $venta_vector[] =$venta;
                }
            }
            return $venta_vector;
        }
        public static function tienePermiso($permiso_id,$tipo){
            //return true;
            if($tipo == "1")
            {
                $array_permisousuario = Permisousuario::getByFields(array(
                    array("field"=>"usuario_id","value"=>Security::getCurrentUserId(),"operator"=>"="),
                    array("field"=>"permiso_id","value"=>$permiso_id,"operator"=>"="),
                    array("field"=>"permisousuario_estado","value"=>"1","operator"=>"=")
                ));
                $array_permisousuario = $array_permisousuario["permisousuario_array"];
                if (sizeof($array_permisousuario) > 0) {
                    return true;
                } else {
                    return false;
                }
            }
            if($tipo == "2"){
                if(!isset($_SESSION["permisos"]))
                    return false;
                $array_permisos = explode("-",$_SESSION["permisos"]);
                foreach ($array_permisos as $value) {
                    if($value == $permiso_id)
                        return true;
                }
                return false;
            }
        }
            public function isLogged() {
                return $this->isLogged;
            }
            public static function canWrite($modulo_id) {
            }
            public static function setSession($nombre, $valor) {
                if (isset($_SESSION[$nombre])) {
                    $_SESSION[$nombre] = $valor;
                } else {
                    $_SESSION[$nombre] = $valor;
            }
            }
            public static function logout() {
                session_destroy();
            }
            public static function getCurrentUserObject() {
                return Venta::getById(Security::getCurrentUserId());
            }
            public static function getSession($nombre) {
                if (isset($_SESSION[$nombre])) {
                    return $_SESSION[$nombre];
                } else {
                    return false;
                }
            }
    public static function getCurrentUserId() {
        if (isset($_SESSION["usuario_id"])) {
            return $_SESSION["usuario_id"];
        } else {

        }
    }

    public static function getCurrentUser() {
        $objUsuario=Usuario::getById(Security::getCurrentUserId());
        if($objUsuario){
            return $objUsuario;
        }else{
            return "";
        }
    }

    public static function getCurrentUsername() {
        if (isset($_SESSION["usuario_nombres"])) {
            return $_SESSION["usuario_nombres"];
        } else {

        }
    }

    public static function getCurrentUserNick() {
        if (isset($_SESSION["usuario_usuario"])) {
            return $_SESSION["usuario_usuario"];
        } else {

        }
    }

    public static function getCurrentLocalId()
    {
        if (isset($_SESSION[strtolower(TABLA_MULTISUCURSAL)."_id"])) {
            return $_SESSION[strtolower(TABLA_MULTISUCURSAL)."_id"];
        } else {
            if (isset($_GET[strtolower(TABLA_MULTISUCURSAL)."_id"])) {
                return $_GET[strtolower(TABLA_MULTISUCURSAL)."_id"];
            } else {
                /**
                 * derepente es un login por token
                 */
                if (Security::getToken()) {
                    $tokenventaObj = Tokenventa::getByToken(Security::getToken());
                    if ($tokenventaObj) {
                        return $tokenventaObj->{strtolower(TABLA_MULTISUCURSAL)._id};
                    }
                }
                return "";
            }
        }
    }

    public static function esVersionOnline()
    {
        if (strpos($_SERVER["SERVER_NAME"], '.pe') !== false || strpos($_SERVER["SERVER_NAME"], '.com') !== false) {
            return true;
        } else {
            return false;
        }
    }

    public static function esSSL()
    {
        if ((isset($_SERVER['HTTP_X_FORWARDED_PORT']) && $_SERVER['HTTP_X_FORWARDED_PORT'] == '443') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) {
            return true;
        } else {
            return false;
        }
    }

    public static function cors()
        {
            // Allow from any origin
            if (isset($_SERVER['HTTP_ORIGIN'])) {
                header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
                header('Access-Control-Allow-Credentials: true');
                header('Access-Control-Max-Age: 86400');    // cache for 1 day
            }
            // Access-Control headers are received during OPTIONS requests
            if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
                if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                    header("Access-Control-Allow-Methods: PUT, GET, POST, OPTIONS, DELETE");
                if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                    header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
                exit(0);
            }
        }

        public static function getPlatform()
        {
            $platform = PLATFORM_ANDROID;
            $headers = apache_request_headers();
            if (isset($headers['platform'])) {
                $platform = $headers['platform'];
            }
            if (isset($headers['Platform'])) {
                $platform = $headers['Platform'];
            }
            return $platform;
        }

        public static function getVersion()
        {
            $version = "";
            $headers = apache_request_headers();
            if (isset($headers['version'])) {
                $version = $headers['version'];
            }
            return $version;
        }

        public static function getClientIdByToken($token)
        {
            $whereParams = array(
                array("field" => "token_valor", "operator" => "=", "conditional" => "=", "value" => $token),
                array("field" => "token_estado", "operator" => "=", "conditional" => "=", "value" => ACTIVO)
            );
            $array_resultado = Token::getByFields($whereParams);
            $array_resultado = $array_resultado["token_array"];
            if (count($array_resultado) == 0) {
                return -1;
            } else {
                /**
                 * validaria si el token debe expirar, y cuando debe expirar
                 */
                foreach ($array_resultado as $token) {

                    if($token->platform_id == null && $token->token_version == null && Security::getVersion() != ""){

                        $platform = null;
                        $App = null;
                        $headers = apache_request_headers();
                        if (isset($headers['Platform'])) {
                            $platform = $headers['Platform'];
                        }

                        if (isset($headers['App'])) {
                            $App = $headers['App'];
                        }

                        if($platform != null && $App != null){
                            $platforms = Platform::getByFields(array(
                                array("field"=>"application_id",  "value"=>$App,"operator"=>"="),
                                array("field"=>"platform_name",  "value"=>$platform,"operator"=>"="),
                            ))["platform_array"];

                            if(count($platforms)>0){
                                $token->platform_id = $platforms[0]->platform_id;
                            }
                        }

                        $token->token_version  =  Security::getVersion();
                        $token->update();

                    }

                }
            }
            return $array_resultado[0]->cliente_id;
        }

        public static function getCurrentClienteId()
        {
            if (isset($_SESSION["cliente_id"])) {
                return $_SESSION["cliente_id"];
            } else {
                if (Security::getToken()) {
                    $client_id = Security::getClientIdByToken(Security::getToken());
                    if ($client_id != -1) {
                        return $client_id;
                    } else {
                        return "0";
                    }
                }
            }
        }

        public static function getTokenObj(){
            $whereParams = array(
                array("field" => "token_valor", "operator" => "=", "conditional" => "=", "value" => Security::getToken()),
                array("field" => "token_estado", "operator" => "=", "conditional" => "=", "value" => ACTIVO)
            );
            $array_resultado = Token::getByFields($whereParams, array(), 0, 0);
            $array_resultado = $array_resultado["token_array"];
            if(sizeof($array_resultado)>0) return $array_resultado[0];
            return null;
        }

        public static function getTokenProveedorObj(){
            $whereParams = array(
                array("field" => "tokenproveedor_valor", "operator" => "=", "conditional" => "=", "value" => Security::getToken()),
                array("field" => "tokenproveedor_estado", "operator" => "=", "conditional" => "=", "value" => ACTIVO)
            );
            $array_resultado = Tokenproveedor::getByFields($whereParams, array(), 0, 0);
            $array_resultado = $array_resultado["tokenproveedor_array"];
            if(sizeof($array_resultado)>0) return $array_resultado[0];
            return null;
        }

        public static function getCurrentSimboloMoneda()
        {
            return "S/";
        }

        public static function getCountry_id()
        {
            $country = PAIS_PERU;
            $headers = apache_request_headers();
            if (isset($headers['Countryid'])) {
                $country = $headers['Countryid'];
            }
            return $country;
        }

        public static function getAppId()
        {
            $appId = ID_APLICACION_CANCHITA;
            //$appId = ID_APLICACION_RESTAURANTGO;
            $headers = apache_request_headers();
            if (isset($headers['App'])) {

                if(Utility::validarEnteroPositivo($headers['App'])){
                    $appId = $headers['App'];
                }

            }
            return $appId;
        }


        public static function getUsuarioProveedorIdByToken($token)
        {
            $whereParams = array(
                array("field" => "tokenproveedor_valor", "operator" => "=", "conditional" => "=", "value" => $token),
                array("field" => "tokenproveedor_estado", "operator" => "=", "conditional" => "=", "value" => ACTIVO)
            );
            $array_resultado = Tokenproveedor::getByFields($whereParams);
            $array_resultado = $array_resultado["tokenproveedor_array"];
            if (count($array_resultado) == 0) {
                return -1;
            } else {

                $fechaActual = Utility::getFechaActual();
                if(!Utility::esFechaValida($array_resultado[0]->tokenproveedor_ultimoacceso) || Utility::getDiferenciaMinutos($array_resultado[0]->tokenproveedor_ultimoacceso,$fechaActual)>15){
                    $array_resultado[0]->tokenproveedor_ultimoacceso = Utility::getFechaHoraActual();
                    $array_resultado[0]->update();
                }

            }
            return $array_resultado[0]->login_id;
        }

        public static function getIP(){
            return $_SERVER['REMOTE_ADDR'];
        }



    }

?>
