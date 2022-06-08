<?php 
class Loginproveedor extends LoginproveedorEntity {

    public static function getProveedoresByUsuario($usuario_id)
    {
        global $pdo;
        $salida_vector = array();
        $sqlWhere = "";

        $sql = "SELECT lp.*, p.proveedor_nombre, p.proveedor_ruc
                FROM loginproveedor lp 
                inner join proveedor p on lp.proveedor_id = p.proveedor_id
                WHERE login_id = '".$usuario_id."'";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Loginproveedor');
        $salida = array();
        while ($salida = $stmt->fetch()) {
            $salida_vector[] = $salida;
        }
        return $salida_vector;
    }

 }
?>