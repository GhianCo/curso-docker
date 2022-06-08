<?php 
class Tokenproveedor extends TokenproveedorEntity {

    public static function getUltimaFechaOperacion($proveedor_id){

        $tokenproveedorList = Tokenproveedor::findWithQuery("select *  from tokenproveedor tp 
                                inner join loginproveedor lp on tp.login_id = lp.login_id
                                 where proveedor_id = ?  order by tokenproveedor_ultimoacceso desc limit 1" , array($proveedor_id));

        if(count($tokenproveedorList)>0){
            return $tokenproveedorList[0]->tokenproveedor_ultimoacceso;
        }
        return "-";

    }
    public static function generarToken($obj){
        $token = new Tokenproveedor();
        $token->setTokenproveedor_fecha(date(Utility::getFechaHoraActual()));
        $token->setTokenproveedor_fechaexpiracion(Utility::addTimeToDate($token->getTokenproveedor_fecha(),"6 day"));
        $token->setTokenproveedor_debeexpirar(NO);
        $token->setTokenproveedor_estado(ACTIVO);
        if (isset($obj->device_id) && $obj->device_id) {
            $token->setTokenproveedor_deviceid($obj->device_id);
        }
        if (isset($obj->device_name) && $obj->device_name) {
            $token->setTokenproveedor_device($obj->device_name);
        }
        if (isset($obj->token_fcm) && $obj->token_fcm) {
            $token->setTokenproveedor_fcm($obj->token_fcm);
        }
        if (isset($obj->token_version) && $obj->token_version) {
            $token->setTokenproveedor_version($obj->token_version);
        }

        $token->platform_id = Platform::getPlatformID(Security::getAppId(), Security::getPlatform());

        $token->setLogin_id($obj->login_id);
        $token->setTokenproveedor_valor(md5($token->getTokenproveedor_fecha() . $token->getLogin_id() . "APPPROVEEDOR"));
        $token->insert();

        return $token;
    }

    public static function obtenerTokenDispositivosAndroid($proveedor_id, $device_id = null){
        $sqlWhere = "";
        if($device_id){
            $sqlWhere = " and tokenproveedor_deviceid = '" . $device_id . "' ";
        }
        $tokenproveedorList = Tokenproveedor::findWithQuery("select distinct tokenproveedor_fcm from tokenproveedor tp inner join loginproveedor lp on tp.login_id = lp.login_id where tokenproveedor_fcm is not null and tokenproveedor_fcm != '' and platform_id in (SELECT platform_id from platform where platform_name = '".PLATFORM_ANDROID."') and proveedor_id = ? " . $sqlWhere, array($proveedor_id));
        $arrayToken = array();
        foreach ($tokenproveedorList as $tokenproveedor){
            $arrayToken[] = $tokenproveedor->tokenproveedor_fcm;
        }
        return $arrayToken;
    }

    public static function obtenerTokenDispositivosiOS($proveedor_id, $device_id = null){
        $sqlWhere = "";
        if($device_id){
            $sqlWhere = " and tokenproveedor_deviceid = '" . $device_id . "' ";
        }
        $tokenproveedorList = Tokenproveedor::findWithQuery("select distinct tokenproveedor_fcm from tokenproveedor tp inner join loginproveedor lp on tp.login_id = lp.login_id where tokenproveedor_fcm is not null and tokenproveedor_fcm != '' and platform_id in (SELECT platform_id from platform where platform_name = '".PLATFORM_IOS."') and proveedor_id = ? " . $sqlWhere, array($proveedor_id));
        $arrayToken = array();
        foreach ($tokenproveedorList as $tokenproveedor){
            $arrayToken[] = $tokenproveedor->tokenproveedor_fcm;
        }
        return $arrayToken;
    }
 }
?>