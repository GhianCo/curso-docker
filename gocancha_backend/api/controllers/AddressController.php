<?php 
class AddressController { 
     function __construct() { 
        $db = DB::getInstance();
        $pdo = $db->dbh;
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    public function add($obj) {
    	$data = array();
    	$mensajes = array();
    	$tipo = SUCCESS;
    	$datos = '';
    	if (empty($mensajes)) {
    		$obj = new Address($obj);
    		$resultado = $obj->insert();
    		if ($resultado) {
    			$tipo = SUCCESS;
    			$mensajes[] = 'Se agregó con éxito.';
    			$datos = $resultado;
    		} else {
    			$tipo = DANGER;
    			$mensajes[] = 'Se produjo un error al crear. Inténtalo de nuevo.';
    		}
    	}
    	$data['mensajes'] = $mensajes;
    	$data['tipo'] = $tipo;
    	$data['data'] = $datos;
    	return $data;
    }
    
    public function update($obj) {
    	$data = array();
    	$mensajes = array();
    	$tipo = SUCCESS;
    	if (empty($mensajes)) {
    		$obj=new Address($obj);
    		$resultado = $obj->update();
    		if ($resultado) {
    			$tipo = SUCCESS;
    			$mensajes[] = 'Se actualizó con éxito.';
    		} else {
    			$tipo = DANGER;
    			$mensajes[] = 'Se produjo un error al modificar. Inténtalo de nuevo.';
    		}
    	}
    	$data['mensajes'] = $mensajes;
    	$data['tipo'] = $tipo;
    	return $data;
    }
    
    public function getById($id) {
    	$data = array();
    	$mensajes = array();
    	$tipo = SUCCESS;
    	$datos = Address::getById($id);
    	if(!$datos){
    		$mensajes[] = 'Error, Valor no Encontrado';
    		$tipo = DANGER;
    	}
    	$data['mensajes'] = $mensajes;
    	$data['tipo'] = $tipo;
    	$data['data'] = $datos;
    	return $data;
    }
    
    public function delete($id) {
    	$data = array();
    	$mensajes = array();
    	$tipo = SUCCESS;
    	$obj = Address::getById($id);
    	if($obj!=false){
    	$obj->delete();
    	}else{
    		$mensajes[] = 'Error, Valor no Encontrado';
    		$tipo = DANGER;
    	}
    	$data['mensajes'] = $mensajes;
    	$data['tipo'] = $tipo;
    	return $data;
    }
    
    public function listarPorPaginacion($busqueda,$pagina,$registros) {
    	$data = array();
    	$mensajes = array();
    	$tipo = SUCCESS;
      $sqlWhere = array();
      if($busqueda != REST_TODOS){
      	$sqlWhere[] = array('field'=>'address_descripcion','value'=>$busqueda,'operator'=>'=');
      }
    	$array_salida = Address::getByParams($sqlWhere,array(),($pagina-1)*$registros,$registros);
    	$totalCount=$array_salida['totalCount'];
    	$array_salida=$array_salida['address_array'];
    	$datos=$array_salida;
    	$data['mensajes'] = $mensajes;
    	$data['tipo'] = $tipo;
    	$data['data'] = $datos;
    	$data['totalregistros'] = $totalCount;
    	return $data;
    }
    
    public function getAllActivos() {
    	$data = array();
    	$mensajes = array();
    	$tipo = SUCCESS;
    	$array_salida = Address::getByParams(array(
    	array('field'=>'address_estado','value'=>'1','operator'=>'=')
    	));
    	$datos=$array_salida['address_array'];
    	$data['mensajes'] = $mensajes;
    	$data['tipo'] = $tipo;
    	$data['data'] = $datos;
    	return $data;
    }

    public function consultarGeolocalizacion($query)
    {

        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = array();

        $array_retorno = array();

        if (empty($mensajes)) {

            $array_retorno = Address::consultarGeolocalizacion($query);

        }


        $data["mensajes"] = $mensajes;
        $data["tipo"] = $tipo;
        $data["data"] = $array_retorno;

        return $data;

    }

    public function getPlaceById($placeID){
        $tipo = SUCCESS;
        $mensajes = array();
        $datos = null;
        $placeObj = null;

        $obj = Address::peticionMapsPlace($placeID);

        if (isset($obj->status) && $obj->status == 'OK') {

            $result = $obj->result;

            if($result){

                $placeObj = new stdClass();
                $placeObj->place_id = $placeID;
                $placeObj->place_lat = $result->geometry->location->lat;
                $placeObj->place_lng = $result->geometry->location->lng;
                $placeObj->place_name = $result->name;
                $placeObj->place_address = $result->formatted_address;

            }else{
                $tipo = ERROR;
                $mensajes[] = "Problemas consultando el sitio.";
            }


        } else {
            $tipo = ERROR;
            $mensajes[] = "Problemas consultando el sitio.";
        }

        $data["tipo"] = $tipo;
        $data["mensajes"] = $mensajes;
        $data["data"] = $placeObj;
        return $data;
    }

    public function getAddressByLocation($latitud, $longitud){
        $tipo = SUCCESS;
        $datos = array();
        $mensajes = array();
        $datos = null;
        $obj = new stdClass();

        $data = Utility::peticionClient("https://maps.googleapis.com/maps/api/geocode/json?latlng=".$latitud.",".$longitud."&key=".GOOGLE_API_KEY,"GET");
        $obj = $data["data"];

        $localidad = "";
        $route = "";
        $calle = "";

        if(isset($obj->status) && $obj->status=='OK'){
            $results = $obj->results;
            for($i = 0;$i<sizeof($results);$i++){
                if($localidad){
                    break;
                }
                $address_components = $results[$i]->address_components;

                for($y=0;$y<sizeof($address_components);$y++){
                    if($localidad){
                        break;
                    }
                    $component = $address_components[$y];
                    if(isset($component->types)){
                        $types = $component->types;
                        foreach ($types as $type){

                            if(empty($route) && $type == "route"){
                                $route = $component->long_name;
                            }
                            if(empty($calle) && $type == "street_number"){
                                $calle = $component->long_name;
                            }

                            if($type == "sublocality"){
                                $localidad = $component->short_name;
                                break;
                            }
                            if($type == "locality"){
                                $localidad = $component->short_name;
                                break;
                            }
                            if($type == "administrative_area_level_2"){
                                $localidad = $component->short_name;
                                break;
                            }

                        }
                    }
                }
            }
            if(!$localidad){
                $tipo = ERROR;
                $mensajes[] = "No se encontro una localidad";
            }

        } else{
            $tipo = ERROR;
            $mensajes[] = "Problemas consultando latitud y longitud";
        }
        if(empty($mensajes)){
            $objAddress = new stdClass();

            $objAddress->address = $localidad;
            $objAddress->locality = $localidad;

            if(!empty($calle) || empty($route)){
                $objAddress->address = $route . " " . $calle . ", " . $objAddress->address ;
            }

            $datos = $objAddress;
        }
        $data["tipo"] = $tipo;
        $data["mensajes"] = $mensajes;
        $data["data"] = $datos;
        return $data;
    }
    
}
?>