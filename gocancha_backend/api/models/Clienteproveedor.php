<?php 
class Clienteproveedor extends ClienteproveedorEntity {

    public static function clienteInactivoProveedor($cliente_id, $proveedor_id){

        global $pdo;

        $sql = "SELECT count(*) 
                FROM clienteproveedor
                WHERE cliente_id = :cliente_id and proveedor_id = :proveedor_id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_STR);
        $stmt->bindParam(':proveedor_id', $proveedor_id, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row && $row > 0) {
            return true;
        } else {
            return false;
        }

    }

    public static function eliminarClienteProveedor($cliente_id, $proveedor_id){
        Clienteproveedor::executeQuery("DELETE FROM clienteproveedor where cliente_id = ? and proveedor_id = ?", array($cliente_id, $proveedor_id));
    }

    public static function executeQuery($query, $params = array()){
        global $pdo;
        $stmt = $pdo->prepare($query);
        for ($i=0 ; $i < sizeof($params) ; $i++){
            $stmt->bindValue($i+1, $params[$i]);
        }
        $resultado = $stmt->execute();
        return $resultado;
    }

 }
?>