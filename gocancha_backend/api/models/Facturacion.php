<?php 
class Facturacion extends FacturacionEntity {

    public static function getFactProveedor($proveedor_id, $f1, $f2)
    {
        global $pdo;
        $proveedor_vector = array();

        $sql = "SELECT *
                FROM facturacion 
                where proveedor_id = ".$proveedor_id." and facturacion_fechainicio >= '".$f1."'
                and facturacion_fechainicio <= '".$f2."'";

        $stmt = $pdo->prepare($sql);

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Facturacion");
        while ($proveedor = $stmt->fetch()) {
            $proveedor_vector[] = $proveedor;
        }
        return $proveedor_vector;
    }
 }
?>