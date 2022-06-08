<?php 
class Usuarioproveedor extends UsuarioproveedorEntity {

    public static function getProveedoresByUsuario($usuario_id)
    {
        global $pdo;
        $salida_vector = array();
        $sqlWhere = "";

        $sql = "SELECT * 
                FROM usuarioproveedor oc 
                inner join proveedor o on oc.proveedor_id = o.proveedor_id
                WHERE usuario_id = '".$usuario_id."'";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Usuarioproveedor');
        $salida = array();
        while ($salida = $stmt->fetch()) {
            $salida_vector[] = $salida;
        }
        return array("salida_array" => $salida_vector);
    }

    public static function existeVinculoUsuarioProveedor($usuario_id,$proveedor_id)
    {
        global $pdo;

        $sql = "SELECT * FROM usuarioproveedor WHERE usuario_id = '".$usuario_id."' and proveedor_id = '" . $proveedor_id . "' ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return true;
        } else {
            return false;
        }
    }

    public static function crearVinculoUsuarioProveedor($usuario_id,$proveedor_id)
    {
        if(!self::existeVinculoUsuarioProveedor($usuario_id,$proveedor_id)){
            $usuarioProveedor = new Usuarioproveedor();
            $usuarioProveedor->setUsuario_id($usuario_id);
            $usuarioProveedor->setProveedor_id($proveedor_id);
            $usuarioProveedor->insert();
        }
    }

    public static function totalProveedores($usuario_id)
    {
        global $pdo;

        $sql = "SELECT count(*) FROM usuarioproveedor WHERE usuario_id = '".$usuario_id."' ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    }


}
?>