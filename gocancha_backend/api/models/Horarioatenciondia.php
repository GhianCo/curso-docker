<?php 
class Horarioatenciondia extends HorarioatenciondiaEntity {

    public static function getHorarioByID($proveedor_id){

        $array_where = array();
        $array_where[] = array("field"=>"proveedor_id","value"=>$proveedor_id,"operator"=>"=");

        $horarioatenciondiaList = Horarioatenciondia::getByFields($array_where,array(),0,0);
        $horarioatenciondia_array = $horarioatenciondiaList["horarioatenciondia_array"];

        foreach ($horarioatenciondia_array as $dia){
            $dia->horarioatencionList = Horarioatencion::getByFields(array(array("field"=>"horarioatenciondia_id","value"=>$dia->horarioatenciondia_id,"operator"=>"=")),array(),0,0)["horarioatencion_array"];
        }

        return $horarioatenciondia_array;
    }

    public static function getHorarioDiaByID($proveedor_id, $dia){

        $array_where = array();
        $array_where[] = array("field"=>"proveedor_id","value"=>$proveedor_id,"operator"=>"=");
        $array_where[] = array("field"=>"horarioatenciondia_dia","value"=>$dia,"operator"=>"=");
        $array_where[] = array("field"=>"horarioatenciondia_estado","value"=>ACTIVO,"operator"=>"=");

        $horarioatenciondiaList = Horarioatenciondia::getByFields($array_where,array(),0,0);
        $horarioatenciondia_array = $horarioatenciondiaList["horarioatenciondia_array"];

        foreach ($horarioatenciondia_array as $dia){
            $dia->horaList = Horarioatencion::getByFields(array(array("field"=>"horarioatenciondia_id","value"=>$dia->horarioatenciondia_id,"operator"=>"=")),array(),0,0)["horarioatencion_array"];
        }

        return $horarioatenciondia_array;
    }

    public static function getHorarioDisponiblesDiaHora($proveedor_id, $dia, $horainicio, $horafin){

        global $pdo;


        $_vector = array();

        $sqlLimit = "";


        $sqlWhere = "";

        $sqlOrder = "order by h.horarioatencion_inicio asc ";

        $horaInicio = Utility::formatearHoraSinSegundos($horainicio);
        $horaFin = Utility::formatearHoraSinSegundos($horafin);


        $sql = "select *
                from horarioatenciondia ha 
                inner join horarioatencion h on ha.horarioatenciondia_id = h.horarioatenciondia_id
                where proveedor_id = $proveedor_id and horarioatenciondia_dia = $dia 
                and horarioatenciondia_estado = ".ACTIVO." and h.horarioatencion_inicio >= '$horaInicio' and h.horarioatencion_fin <= '$horaFin' 
                ".$sqlOrder . $sqlLimit;
        $stmt = $pdo->prepare($sql);


        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        while ($obj = $stmt->fetch()) {
            $_vector[] = $obj;
        }
        return $_vector;
    }

 }
?>