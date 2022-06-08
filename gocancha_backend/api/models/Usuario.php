<?php 
class Usuario extends UsuarioEntity {

    public static function iniciarSesion($username, $password) {

        $usuario = Usuario::getByFields(array(array("field" => "usuario_usuario", "operator" => "=", "conditional" => "AND", "value" => $username),
            array("field" => "usuario_clave", "operator" => "=", "conditional" => "AND", "value" => $password),
            array("field" => "usuario_estado", "operator" => "=", "conditional" => "AND", "value" => 1)
        ));
        $usuario_array = $usuario["usuario_array"];
        if (sizeof($usuario_array) > 0) {
            $usuarioObj = $usuario_array[0];
            return $usuarioObj;
        } else {
            return new Usuario();
        }
    }

 }
?>