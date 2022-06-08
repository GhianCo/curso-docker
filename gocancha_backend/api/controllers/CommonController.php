<?php 
class CommonController {
     function __construct() { 
        $db = DB::getInstance();
        $pdo = $db->dbh;
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getDeportes() {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;

        $datos = Deporte::obtenerDeporteHome();


        $data['mensajes'] = $mensajes;
        $data['tipo'] = $tipo;
        $data['data'] = $datos;
        return $data;
    }

    function getProveedoresCerca($obj = null){

        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;

        $datos = array();
        $totalCount = 0;

        if(!isset($obj->latitud)){
            $tipo = ERROR;
            $mensajes[] = "El parametro latitud es obligatorio";
        }

        if(!isset($obj->longitud)){
            $tipo = ERROR;
            $mensajes[] = "El parametro longitud es obligatorio";
        }

        if(!isset($obj->pagina)){
            $tipo = ERROR;
            $mensajes[] = "El parametro pagina es obligatorio";
        }

        if(!isset($obj->registros)){
            $tipo = ERROR;
            $mensajes[] = "El parametro registros es obligatorio";
        }

        $deporte_id = PARAM_TODOS;
        if(isset($obj->deporte_id)){
            $deporte_id = $obj->deporte_id;
        }

        if(empty($mensajes)){

            $array_data = Proveedor::obtenerCanchasCercaPaginado($obj->latitud, $obj->longitud, $deporte_id, $obj->pagina, $obj->registros);

            $datos = $array_data["proveedor_array"];
            $totalCount = $array_data["totalCount"];

        }


        $data["mensajes"] = $mensajes;
        $data["tipo"] = $tipo;
        $data["data"] = $datos;
        $data["totalregistros"] = $totalCount;

        return $data;
    }


    public function getProveedoresFavoritos($deporte_id = PARAM_TODOS) {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;

        $datos = array();
        $totalCount = 0;

        if(empty($mensajes)){

            $array_data = Proveedor::getProveedoresFavoritosPaginado(Security::getCurrentClienteId(), $deporte_id);

            $datos = $array_data["proveedor_array"];
            $totalCount = $array_data["totalCount"];
        }



        $data["mensajes"] = $mensajes;
        $data["tipo"] = $tipo;
        $data["data"] = $datos;
        $data["totalregistros"] = $totalCount;

        return $data;
    }

    public function getCuentasList(){
        $data = array();
        $tipo = SUCCESS;
        $mensajes = array();
        $datos = "";
        if(empty($mensajes)){
            $arrayCuentas = array();

            //$arrayCuentas[] = array("entidad_nombre" => "Yape", "entidad_numero" => "977835644", "entidad_titular" => "Grupo I&Q S.A.C");
            //$arrayCuentas[] = array("entidad_nombre" => "Plin", "entidad_numero" => "961754951", "entidad_titular" => "Reyson FC");
            $arrayCuentas[] = array("entidad_nombre" => "Yape", "entidad_numero" => "977835644", "entidad_titular" => "Grupo I&Q S.A.C");
            $arrayCuentas[] = array("entidad_nombre" => "BCP cta. corriente", "entidad_numero" => "1939850342002", "entidad_titular" => "Grupo I&Q S.A.C");
            //$arrayCuentas[] = array("entidad_nombre" => "BBVA cta. corriente", "entidad_numero" => "0011-0267-0201115305", "entidad_titular" => "Reyson FC");
            //$arrayCuentas[] = array("entidad_nombre" => "Interbank cta. corriente", "entidad_numero" => "8983126971704", "entidad_titular" => "Reyson FC");
            $arrayCuentas[] = array("entidad_nombre" => "Interbank cta. corriente", "entidad_numero" => "8983003940807", "entidad_titular" => "Grupo I&Q S.A.C");

            $datos = $arrayCuentas;
        }
        $data["tipo"] = $tipo;
        $data["mensajes"] = $mensajes;
        $data["data"] = $datos;
        return $data;
    }

    public function getSupportList(){
        $data = array();
        $tipo = SUCCESS;
        $mensajes = array();
        $datos = "";
        if(empty($mensajes)){
            $arrayData = array();

            $arrayData[] = array("email" => "soporte@gocancha.com", "fullname" => "", "numberphone" => "");
            $arrayData[] = array("email" => "comercial@gocancha.com", "fullname" => "", "numberphone" => "");

            $datos = $arrayData;
        }
        $data["tipo"] = $tipo;
        $data["mensajes"] = $mensajes;
        $data["data"] = $datos;
        return $data;
    }

    public function getSupportListProveedor(){
        $data = array();
        $tipo = SUCCESS;
        $mensajes = array();
        $datos = "";
        if(empty($mensajes)){
            $arrayData = array();

            $arrayData[] = array("email" => "soporte@gocancha.com", "fullname" => "", "numberphone" => "", "type"=>"email");
            $arrayData[] = array("email" => "comercial@gocancha.com", "fullname" => "", "numberphone" => "", "type"=>"email");
            $arrayData[] = array("email" => "", "fullname" => "", "numberphone" => "+51977835644", "type"=>"number");

            $datos = $arrayData;
        }
        $data["tipo"] = $tipo;
        $data["mensajes"] = $mensajes;
        $data["data"] = $datos;
        return $data;
    }

}
?>