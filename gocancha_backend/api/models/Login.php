<?php 
class Login extends LoginEntity {

    public static function iniciarSesion($loginObj)
    {
        $login = null;

        if (isset($loginObj->login_usuario) && $loginObj->login_usuario != "" && isset($loginObj->login_clave) && $loginObj->login_clave != "") {

            $login_array = Login::findWithQuery("SELECT * FROM login WHERE login_usuario = ? and login_clave = ? and login_estado = ? limit 1", array($loginObj->login_usuario, $loginObj->login_clave, ACTIVO));
            if (sizeof($login_array) > 0) {
                $login = $login_array[0];
            }
        }

        return $login;
    }
 }
?>