<?php 
class Favorito extends FavoritoEntity {
    public static function esProveedorFavorito($client_id, $proveedor_id)
    {
        global $pdo;

        $sql = "SELECT * from favorito  where cliente_id = ".$client_id."  and proveedor_id = ".$proveedor_id." limit 1 " ;
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();
        if ($row) {
            return SI;
        } else {
            return NO;
        }
    }
 }
?>