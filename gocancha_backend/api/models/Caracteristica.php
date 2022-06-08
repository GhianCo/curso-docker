<?php 
class Caracteristica extends CaracteristicaEntity {

    public static function getAllActivos(){
        $array_salida = Caracteristica::getByFields(array(
            array('field'=>'caracteristica_estado','value'=>'1','operator'=>'=')
        ));
        return $array_salida['caracteristica_array'];
    }

 }
?>