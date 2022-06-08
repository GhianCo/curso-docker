<?php 
class Address extends AddressEntity {

    public static function consultarGeolocalizacion($query){

        $array_retorno = array();

        $query = str_replace(' ', '+', $query);
        $url = "https://maps.googleapis.com/maps/api/place/autocomplete/json?input=" . urlencode($query) . "&language=es_PE&components=country:pe&key=" . GOOGLE_API_KEY;

        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
        ));
        // Send the request & save response to $resp
        $curl_response = curl_exec($curl);

        // Close request to clear up some resources
        curl_close($curl);


        if ($curl_response) {
            $obj = json_decode($curl_response);

            try{
                //Con la respuesta de google formeteo la data para front
                $obj->results = array();

                if (isset($obj->predictions)) {

                    foreach ($obj->predictions as $prediction) {

                        $prediccionObj = new stdClass();
                        $prediccionObj->address = $prediction->structured_formatting->main_text;

                        // Fix para cuando API de google no retorne el secondary text
                        $prediccionObj->description = "";

                        if(isset($prediction->structured_formatting->secondary_text)){
                            $prediccionObj->description = $prediction->structured_formatting->secondary_text;
                        }

                        $prediccionObj->provider = "google_places";
                        $prediccionObj->id = $prediction->place_id;

                        $array_retorno[] = $prediccionObj;

                    }
                }
            }catch(Exception $e){
                Utility::capture(new Exception("Posible falta de pago de la api de google"));
            }


        }

        return $array_retorno;
    }

    public static function peticionMapsPlace($placeID){

        $curl = curl_init();

        // Set some options - we are passing in a useragent too here
        $url = "https://maps.googleapis.com/maps/api/place/details/json?place_id=" . $placeID . "&&fields=name,geometry,formatted_address&key=".GOOGLE_API_KEY;
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);

        return json_decode($resp);

    }

    public static function getDefault($client_id){

        $addressList = Address::findWithQuery("SELECT * FROM address where address_default = ? and cliente_id = ?", array(SI, $client_id));
        if(sizeof($addressList) > 0){
            return new Address(get_object_vars($addressList[0]));
        }
        return null;
    }


    public function getByAddressAndClientId($client_id){
        $sql = "SELECT * FROM address 
                where cliente_id = ? and 
                (6371 * ACOS(SIN(RADIANS(address_latitud)) * SIN(RADIANS(?)) 
                                + COS(RADIANS(address_longitud - ?)) * COS(RADIANS(address_latitud)) 
                                * COS(RADIANS(?))
                                )
                   ) < ? limit 1";

        $addressList = Address::findWithQuery($sql, array($client_id, $this->address_latitud, $this->address_longitud, $this->address_latitud, DISTANCE_MIN_ADDRESS));
        if(sizeof($addressList) > 0){
            return $addressList[0];
        }
        return null;
    }

    public static function getAddressId($client_id, $objAddress){
        $address = new Address(get_object_vars($objAddress));
        if(isset($address->address_latitud) && isset($address->address_longitud)){
            $addressAux = $address->getByAddressAndClientId($client_id);
            if($addressAux){

                return $addressAux->address_id;

            }else{

                $data = Address::agregarByCliente($client_id, $address);
                if(isset($data["tipo"]) && $data["tipo"] == SUCCESS){
                    $addressAux = $data["data"];

                    return $addressAux->address_id;
                }
            }
        }



        return null;
    }

    public static function agregarByCliente($cliente_id, $address)
    {
        $data = array();
        $mensajes = array();
        $tipo = SUCCESS;
        $datos = "";

        if (empty($mensajes)) {
            $address = new Address(get_object_vars($address));
            $address->setCliente_id($cliente_id);

            $ctrl = new AddressController();
            $dataGeo = $ctrl->getAddressByLocation($address->getAddress_latitud(), $address->getAddress_longitud());
            if($dataGeo["tipo"] == SUCCESS && isset($dataGeo["data"])){

                $dataGeo = $dataGeo["data"];

                if($address->getCliente_id()) {
                    Address::removeDefault($address->getCliente_id());
                }else{
                    if(is_string($address->getCliente_id()) && $address->getCliente_id() == ""){
                        $address->setCliente_id(null);
                    }
                }
                $address->setAddress_default(SI);


                $address->setAddress_distrito($dataGeo->locality);
                $address->setAddress_estado(ACTIVO);
                if(isset($address->address_direccionusuario) && $address->address_direccionusuario){
                    $address->setAddress_calle($address->address_direccionusuario);
                    $address->setAddress_numero("");
                }

                $resultado = $address->insert();
                if($resultado) {
                    $address->setAddress_id($resultado);
                    $tipo = SUCCESS;
                    $mensajes[] = "Se agrego con éxito.";
                    $datos = $address;
                }else{
                    $tipo = ERROR;
                    $mensajes[] = "Se produjo un error al crear. Intentalo de nuevo.";
                }

            }else{

                $tipo = ERROR;
                $mensajes[] = "No cubrimos tu zona todavia. Muy pronto estaremos cerca de ti";

                $objError = new stdClass();
                $objError->mensajes = $mensajes;
                Utility::capture(new Exception(json_encode($objError)));

            }
        }
        $data["mensajes"] = $mensajes;
        $data["tipo"] = $tipo;
        $data["data"] = $address;
        return $data;
    }

    public static function removeDefault($client_id){
        Address::executeQuery("update address set address_default = ? where cliente_id = ?", array(NO, $client_id));
    }

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