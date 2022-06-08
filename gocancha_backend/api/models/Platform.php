<?php 
class Platform extends PlatformEntity {

    public static function getPlatformID($application_id, $platform){

        global $pdo;

        $sql = "select platform_id
                FROM platform
                WHERE application_id = '".$application_id."'  and platform_name = '".$platform."'  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return $row;
        } else {
            return null;
        }
    }

 }
?>