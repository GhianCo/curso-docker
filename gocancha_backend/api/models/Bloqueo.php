<?php 
class Bloqueo extends BloqueoEntity {

    public static function validarFechaCanchaDisponible($cancha_id, $fecha, $horainicio, $horafin, $cancha_padreid = null){
        global $pdo;

        $sqlWhere = "";
        $horainicio = Utility::formatearHoraSinSegundos($horainicio);
        $horafin = Utility::formatearHoraSinSegundos($horafin);
        $horainicio = Utility::addTimeToDate($fecha . " " . $horainicio, "1 seconds", "H:i:s");
        $fechaActual = Utility::getFechaHoraActual();

        if($cancha_padreid){
            $sqlWhere .= " and (b.cancha_id = $cancha_id or c.cancha_padreid = $cancha_id or b.cancha_id = $cancha_padreid) ";
        }else{
            $sqlWhere .= " and (b.cancha_id = $cancha_id or c.cancha_padreid = $cancha_id) ";
        }


        $sql = "SELECT count(*) 
                FROM bloqueo b
                inner join cancha c on b.cancha_id = c.cancha_id
                where bloqueo_fechareserva = '$fecha'  and '$fechaActual' < bloqueo_fecha
            and ((:horainicio > bloqueo_horainicio and :horainicio <= bloqueo_horafin) 
                or  (:horafin > bloqueo_horainicio and :horafin <= bloqueo_horafin) 
                or  (:horainicio < bloqueo_horainicio and :horafin >= bloqueo_horafin)
                )
            " . $sqlWhere;

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':horainicio',	$horainicio, PDO::PARAM_STR);
        $stmt->bindParam(':horafin', $horafin, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            if($row * 1 > 0){
                return false;
            }
            return true;
        } else {
            return true;
        }
    }

    public static function agregarBloqueo($cancha_id, $obj, $client_id = REST_TODOS){
        $bloqueo = new Bloqueo();
        $bloqueo->cancha_id = $cancha_id;
        $bloqueo->bloqueo_fechareserva = $obj->fechaprogramacion;
        $bloqueo->bloqueo_horainicio = Utility::formatearHoraSinSegundos($obj->horainicio);
        $bloqueo->bloqueo_horafin = Utility::formatearHoraSinSegundos($obj->horafin);
        if(isset($obj->proveedor_id)){

            $bloqueo->bloqueo_fecha = Utility::addTimeToDate(Utility::getFechaHoraActual(), MINUTOS_BLOQUEO_PROVEEDOR. " minutes");
            $bloqueo->proveedor_id = $obj->proveedor_id;
        }else{

            $bloqueo->bloqueo_fecha = Utility::addTimeToDate(Utility::getFechaHoraActual(), MINUTOS_BLOQUEO . " minutes");
            $bloqueo->cliente_id = $client_id;
        }

        $bloqueo->insert();

        return $bloqueo;
    }

    public static function eliminarBloqueosCliente($cliente_id, $cancha_id = REST_TODOS, $fecha = REST_TODOS, $horainicio = REST_TODOS, $horafin = REST_TODOS){

        global $pdo;

        $sqlWhere = "";

        if($cancha_id != REST_TODOS){
            $sqlWhere .= " and cancha_id = $cancha_id";
        }
        if($fecha != REST_TODOS){
            $sqlWhere .= " and bloqueo_fechareserva = '$fecha'";
        }
        if($horainicio != REST_TODOS && $horafin != REST_TODOS){

            $horainicio = Utility::formatearHoraSinSegundos($horainicio);
            $horafin = Utility::formatearHoraSinSegundos($horafin);
            $horainicio = Utility::addTimeToDate($fecha . " " . $horainicio, "1 seconds", "H:i:s");

            $sqlWhere .= " and ((:horainicio > bloqueo_horainicio and :horainicio <= bloqueo_horafin) 
                or  (:horafin > bloqueo_horainicio and :horafin <= bloqueo_horafin) 
                or  (:horainicio < bloqueo_horainicio and :horafin >= bloqueo_horafin)
                )";
        }

        $sql = "DELETE FROM bloqueo 
                where  cliente_id = $cliente_id ".$sqlWhere;

        $stmt = $pdo->prepare($sql);

        if($horainicio != REST_TODOS && $horafin != REST_TODOS){
            $stmt->bindParam(':horainicio',	$horainicio, PDO::PARAM_STR);
            $stmt->bindParam(':horafin', $horafin, PDO::PARAM_STR);
        }

        return $stmt->execute();

    }

    public static function eliminarBloqueosProveedor($proveedor_id, $cancha_id = REST_TODOS, $fecha = REST_TODOS, $horainicio = REST_TODOS, $horafin = REST_TODOS){

        global $pdo;

        $sqlWhere = "";

        if($cancha_id != REST_TODOS){
            $sqlWhere .= " and cancha_id = $cancha_id";
        }
        if($fecha != REST_TODOS){
            $sqlWhere .= " and bloqueo_fechareserva = '$fecha'";
        }
        if($horainicio != REST_TODOS && $horafin != REST_TODOS){

            $horainicio = Utility::formatearHoraSinSegundos($horainicio);
            $horafin = Utility::formatearHoraSinSegundos($horafin);
            $horainicio = Utility::addTimeToDate($fecha . " " . $horainicio, "1 seconds", "H:i:s");

            $sqlWhere .= " and ((:horainicio > bloqueo_horainicio and :horainicio <= bloqueo_horafin) 
                or  (:horafin > bloqueo_horainicio and :horafin <= bloqueo_horafin) 
                or  (:horainicio < bloqueo_horainicio and :horafin >= bloqueo_horafin)
                )";
        }

        $sql = "DELETE FROM bloqueo 
                where  proveedor_id = $proveedor_id ".$sqlWhere;

        $stmt = $pdo->prepare($sql);

        if($horainicio != REST_TODOS && $horafin != REST_TODOS){
            $stmt->bindParam(':horainicio',	$horainicio, PDO::PARAM_STR);
            $stmt->bindParam(':horafin', $horafin, PDO::PARAM_STR);
        }

        return $stmt->execute();

    }



 }
?>