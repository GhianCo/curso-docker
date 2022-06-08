<?php 
class Pagodata extends PagodataEntity {

    public static function registrarPagoData($obj, $reserva_id){
        $pago = new Pagodata();
        $pago->pagodata_json = is_object($obj) ? json_encode($obj) : $obj;
        $pago->pagodata_integracion = TIPO_INTEGRACION_PAGO_NIUBIZ;
        $pago->reserva_id = $reserva_id;
        $pago->insert();
    }

    public static function getDataPagoIntegracionReserva($reserva_id, $integracion){
        global $pdo;



        $sqlWhere = "";




        $sql = "select *
                FROM pagodata 
                where reserva_id = $reserva_id and  pagodata_integracion = '$integracion'
                ".$sqlWhere."  
                ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();
        if ($row) {
            return new Pagodata($row);
        } else {
            return null;
        }
    }

 }
?>