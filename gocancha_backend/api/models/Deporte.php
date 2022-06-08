<?php 
class Deporte extends DeporteEntity {

    public static function obtenerDeporteHome(){
        $datos = array();


        if (empty($mensajes)) {

            $array_deporte = Deporte::getDeporteListHome();

            foreach ($array_deporte as $deporte){

                $datos[] = $deporte;


            }

        }
        return $datos;
    }

    public static function getDeporteListHome(){
        return Deporte::findWithQuery("select * from deporte where deporte_estado = ? order by deporte_orden asc", array(ACTIVO));
    }

    public static function getDeporteListPorProveedor(){
        return Deporte::findWithQuery("select * from deporte d inner join cancha c 
                                            on d.deporte_id=c.deporte_id
                                            where deporte_estado = ? and c.proveedor_id=".Security::getUsuarioProveedorIdByToken(Security::getToken())." group by d.deporte_id order by deporte_orden asc", array(ACTIVO));
    }

    public static function getUltimoDeporte()
    {
        global $pdo;

        $sql = "SELECT max(deporte_orden) FROM deporte WHERE deporte_estado = '".ACTIVO."'";
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