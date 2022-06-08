<?php 
class Proveedorcaracteristica extends ProveedorcaracteristicaEntity {
    public static function obtenerCaracteristicaListByProveedor($proveedor_id){

        $sql = "select * from proveedorcaracteristica pc inner join caracteristica c on c.caracteristica_id = pc.caracteristica_id where proveedor_id = ?";
        return Proveedorcaracteristica::findWithQuery($sql, array($proveedor_id));

    }
 }
?>