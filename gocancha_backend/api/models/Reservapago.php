<?php 
class Reservapago extends ReservapagoEntity {

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