<?php 
class Canchaimagen extends CanchaimagenEntity {

    public static function getImagenesByProveedor($proveedor_id){

        global $pdo;


        $_vector = array();



        $sql = "select ci.*
                from canchaimagen ci 
                inner join cancha c on c.cancha_id = ci.cancha_id
                where proveedor_id = $proveedor_id and cancha_estado = ".ACTIVO." ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Canchaimagen");
        while ($obj = $stmt->fetch()) {
            $_vector[] = $obj;
        }
        return $_vector;
    }

 }
?>