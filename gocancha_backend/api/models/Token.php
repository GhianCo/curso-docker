<?php 
class Token extends TokenEntity {
    public static function generarToken($obj){
        $token = new Token();
        $token->setToken_fecha(date(Utility::getFechaHoraActual()));
        $token->setToken_fechaexpiracion(Utility::addTimeToDate($token->getToken_fecha(),"6 month"));
        $token->setToken_debeexpirar(NO);
        $token->setToken_estado(ACTIVO);
        if (isset($obj->device_id) && $obj->device_id) {
            $token->setToken_deviceid($obj->device_id);
        }
        if (isset($obj->device_name) && $obj->device_name) {
            $token->setToken_device($obj->device_name);
        }
        if (isset($obj->token_fcm) && $obj->token_fcm) {
            $token->setToken_fcm($obj->token_fcm);
        }
        if (isset($obj->token_version) && $obj->token_version) {
            $token->setToken_version($obj->token_version);
        }
        $token->platform_id = Platform::getPlatformID(Security::getAppId(), Security::getPlatform());

        $token->setCliente_id($obj->cliente_id);
        $token->setToken_valor(md5($token->getToken_fecha() . $token->getCliente_id(). "APPCLIENTE"));
        $token->insert();

        return $token;
    }

    public static function obtenerTokenDispositivosAndroid($client_id, $device_id = null){
        $sqlWhere = "";
        if($device_id){
            $sqlWhere = " and token_deviceid = '" . $device_id . "' ";
        }
        $tokenList = Token::findWithQuery("select distinct token_fcm from token where token_fcm is not null and token_fcm != '' and platform_id in (SELECT platform_id from platform where platform_name = '".PLATFORM_ANDROID."') and cliente_id = ? " . $sqlWhere, array($client_id));
        $arrayToken = array();
        foreach ($tokenList as $token){
            $arrayToken[] = $token->token_fcm;
        }
        return $arrayToken;
    }

    public static function obtenerTokenDispositivosiOS($client_id, $device_id = null){
        $sqlWhere = "";
        if($device_id){
            $sqlWhere = " and token_deviceid = '" . $device_id . "' ";
        }
        $tokenList = Token::findWithQuery("select distinct token_fcm from token where token_fcm is not null and token_fcm != '' and platform_id in (SELECT platform_id from platform where platform_name = '".PLATFORM_IOS."') and cliente_id = ? " . $sqlWhere, array($client_id));
        $arrayToken = array();
        foreach ($tokenList as $token){
            $arrayToken[] = $token->token_fcm;
        }
        return $arrayToken;
    }
 }
?>