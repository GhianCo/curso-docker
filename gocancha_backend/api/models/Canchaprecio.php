<?php 
class Canchaprecio extends CanchaprecioEntity {

    public static function getPrecioDiaActualCancha($cancha_id, $fecha = null){
        global $pdo;

        $diaActual = Utility::getDiaSemanaByFecha($fecha ? $fecha : Utility::getFechaHoraActual());

        $sqlWhere = "";

        $sqlWhere .= " and cancha_id = $cancha_id";

        $sqlWhere .= " and canchaprecio_dia = '$diaActual' ";



        $sql = "select *
                FROM canchaprecio 
                where canchaprecio_estado = ".ACTIVO." ".$sqlWhere."   ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();
        if ($row) {
            return new Canchaprecio($row);
        } else {
            return new Canchaprecio();
        }
    }

    public static function getHorarioDiaByID($cancha_id){

        $array_where = array();
        $array_where[] = array("field"=>"cancha_id","value"=>$cancha_id,"operator"=>"=");

        $canchaprecioList = Canchaprecio::getByFields($array_where,array(),0,0);
        $canchaprecio_array = $canchaprecioList["canchaprecio_array"];


        return $canchaprecio_array;
    }

 }
?>