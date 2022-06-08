<?php 
class Cliente extends ClienteEntity {
    public function validarClientePorIDLogin(){

        $validacionCorrecta = true;

        if($this->getCliente_fbid()!= null && $this->getCliente_fbid()!=""){

            if(!$this->existeFBId()){
                $validacionCorrecta = false;
            }

        }elseif ($this->getCliente_gid()!= null && $this->getCliente_gid()!=""){

            if(!$this->existeGId()){
                $validacionCorrecta = false;
            }

        }elseif ($this->getCliente_aid()!= null && $this->getCliente_aid()!=""){

            if(!$this->existeAId()){
                $validacionCorrecta = false;
            }

        }

        return $validacionCorrecta;

    }

    public function existeFBId(){
        $existe = false;
        if($this->getCliente_fbid()) {
            $clientList = Cliente::findWithQuery("SELECT * FROM cliente where cliente_fbid = ?", array($this->getCliente_fbid()));
            if(sizeof($clientList) > 0){
                $existe = true;
            }
        }
        return $existe;
    }
    public function existeGId(){
        $existe = false;
        if($this->getCliente_gid()) {
            $clientList = Cliente::findWithQuery("SELECT * FROM cliente where cliente_gid = ?", array($this->getCliente_gid()));
            if(sizeof($clientList) > 0){
                $existe = true;
            }
        }
        return $existe;
    }
    public function existeAId(){
        $existe = false;
        if($this->getCliente_aid()) {
            $clientList = Cliente::findWithQuery("SELECT * FROM cliente where cliente_aid = ?", array($this->getCliente_aid()));
            if(sizeof($clientList) > 0){
                $existe = true;
            }
        }
        return $existe;
    }

    public function verificarCliente(){


        $this->cliente_esnuevo = false;

        if($this->getCliente_fbid()!= null && $this->getCliente_fbid()!=""){

            if(!Utility::valorEstaVacio($this->cliente_telefono)){

                $objClienteAux = Cliente::getByFBId($this->getCliente_fbid());

                if($objClienteAux){

                    $objClienteAux->setCliente_activado(SI);
                    $objClienteAux->setCliente_telefono($this->getCliente_telefono());
                    $objClienteAux->update();

                }else{

                    $objClienteAux = Cliente::obtenerClientePorTelefono($this->getCliente_telefono());

                    if($objClienteAux){

                        $objClienteAux->setCliente_activado(SI);
                        $objClienteAux->setCliente_fbid($this->getCliente_fbid());
                        $objClienteAux->update();

                    }else{

                        $this->setCliente_estado(ACTIVO);
                        $this->setCliente_activado(SI);
                        $this->setCliente_fecharegistro(Utility::getFechaHoraActual());
                        $this->setCliente_tipocomprobante(1);
                        $this->setCliente_numerodoc(111111111);
                        $this->setCliente_id($this->insert());
                        $this->cliente_esnuevo = true;

                    }

                }
            }else{
                if(!$this->existeFBId()){

                    $this->setCliente_estado(ACTIVO);
                    $this->setCliente_activado(SI);
                    $this->setCliente_fecharegistro(Utility::getFechaHoraActual());
                    $this->setCliente_tipocomprobante(1);
                    $this->setCliente_numerodoc(111111111);
                    $this->setCliente_id($this->insert());
                    $this->cliente_esnuevo = true;

                }



            }
        }elseif($this->getCliente_gid()!= null && $this->getCliente_gid()!=""){

            if(!Utility::valorEstaVacio($this->cliente_telefono)){

                $objClienteAux = Cliente::getByGId($this->getCliente_gid());

                if($objClienteAux){

                    $objClienteAux->setCliente_activado(SI);
                    $objClienteAux->setCliente_telefono($this->getCliente_telefono());
                    $objClienteAux->update();

                }else{

                    $objClienteAux = Cliente::obtenerClientePorTelefono($this->getCliente_telefono());

                    if($objClienteAux){

                        $objClienteAux->setCliente_activado(SI);
                        $objClienteAux->setCliente_gid($this->getCliente_gid());
                        $objClienteAux->update();

                    }else{

                        $this->setCliente_estado(ACTIVO);
                        $this->setCliente_activado(SI);
                        $this->setCliente_fecharegistro(Utility::getFechaHoraActual());
                        $this->setCliente_tipocomprobante(1);
                        $this->setCliente_numerodoc(111111111);
                        $this->setCliente_id($this->insert());
                        $this->cliente_esnuevo = true;
                    }

                }
            }else{

                if(!$this->existeGId()){

                    $this->setCliente_estado(ACTIVO);
                    $this->setCliente_activado(SI);
                    $this->setCliente_fecharegistro(Utility::getFechaHoraActual());
                    $this->setCliente_tipocomprobante(1);
                    $this->setCliente_numerodoc(111111111);
                    $this->setCliente_id($this->insert());
                    $this->cliente_esnuevo = true;

                }

            }
        }elseif($this->getCliente_aid()!= null && $this->getCliente_aid()!=""){

            if(!Utility::valorEstaVacio($this->cliente_telefono)){

                $objClienteAux = Cliente::getByAId($this->getCliente_aid());

                if($objClienteAux){

                    $objClienteAux->setCliente_activado(SI);
                    $objClienteAux->setCliente_telefono($this->getCliente_telefono());
                    $objClienteAux->update();

                }else{

                    $objClienteAux = Cliente::obtenerClientePorTelefono($this->getCliente_telefono());

                    if($objClienteAux){

                        $objClienteAux->setCliente_activado(SI);
                        $objClienteAux->setCliente_aid($this->getCliente_aid());
                        $objClienteAux->update();

                    }else{

                        $this->setCliente_estado(ACTIVO);
                        $this->setCliente_activado(SI);
                        $this->setCliente_fecharegistro(Utility::getFechaHoraActual());
                        $this->setCliente_tipocomprobante(1);
                        $this->setCliente_numerodoc(111111111);
                        $this->setCliente_id($this->insert());
                        $this->cliente_esnuevo = true;
                    }

                }
            }else{

                if(!$this->existeAId()){

                    $this->setCliente_estado(ACTIVO);
                    $this->setCliente_activado(SI);
                    $this->setCliente_fecharegistro(Utility::getFechaHoraActual());
                    $this->setCliente_tipocomprobante(1);
                    $this->setCliente_numerodoc(111111111);
                    $this->setCliente_id($this->insert());
                    $this->cliente_esnuevo = true;

                }

            }
        }elseif(!Utility::valorEstaVacio($this->cliente_telefono)){

            $objClienteAux = Cliente::obtenerClientePorTelefono($this->getCliente_telefono());

            if($objClienteAux){

                $objClienteAux->setCliente_activado(SI);
                $objClienteAux->setCliente_telefono($this->getCliente_telefono());
                $objClienteAux->update();

            }else{

                $this->setCliente_estado(ACTIVO);
                $this->setCliente_activado(SI);
                $this->setCliente_fecharegistro(Utility::getFechaHoraActual());
                $this->setCliente_tipocomprobante(1);
                $this->setCliente_numerodoc(111111111);
                $this->setCliente_id($this->insert());
                $this->cliente_esnuevo = true;

            }
        }

    }

    public static function getByFBId($fbid){
        $clientList = Cliente::findWithQuery("SELECT * FROM cliente where cliente_fbid = ?", array($fbid));
        if(sizeof($clientList) > 0){
            return $clientList[0];
        }
        return null;
    }
    public static function getByGId($gid){
        $clientList = Cliente::findWithQuery("SELECT * FROM cliente where cliente_gid = ?", array($gid));
        if(sizeof($clientList) > 0){
            return $clientList[0];
        }
        return null;
    }
    public static function getByAId($aid){
        $clientList = Cliente::findWithQuery("SELECT * FROM cliente where cliente_aid = ?", array($aid));
        if(sizeof($clientList) > 0){
            return $clientList[0];
        }
        return null;
    }

    public static function obtenerClientePorTelefono($telefono){

        $clientList = Cliente::findWithQuery("SELECT * FROM cliente where cliente_telefono = ?", array($telefono));
        if(sizeof($clientList) > 0){
            return $clientList[0];
        }
        return false;
    }

    public static function iniciarSesionMultiple($clienteObj)
    {
        $cliente = null;

        if(isset($clienteObj->cliente_fbid) && $clienteObj->cliente_fbid!=""){

            $cliente_array = Cliente::findWithQuery("SELECT * FROM cliente WHERE cliente_fbid = ? limit 1", array($clienteObj->cliente_fbid));
            if(sizeof($cliente_array)>0){
                $cliente = $cliente_array[0];
            }

        }elseif(isset($clienteObj->cliente_gid) && $clienteObj->cliente_gid!=""){

            $cliente_array = Cliente::findWithQuery("SELECT * FROM cliente WHERE cliente_gid = ? limit 1", array($clienteObj->cliente_gid));
            if(sizeof($cliente_array)>0){
                $cliente = $cliente_array[0];
            }

        }elseif(isset($clienteObj->cliente_aid) && $clienteObj->cliente_aid!=""){

            $cliente_array = Cliente::findWithQuery("SELECT * FROM cliente WHERE cliente_aid = ? limit 1", array($clienteObj->cliente_aid));
            if(sizeof($cliente_array)>0){
                $cliente = $cliente_array[0];
            }

        }elseif(isset($clienteObj->cliente_telefono) && $clienteObj->cliente_telefono!=""){

            $cliente_array = Cliente::findWithQuery("SELECT * FROM cliente WHERE cliente_telefono = ? and cliente_estado = ? limit 1", array($clienteObj->cliente_telefono, ACTIVO));
            if(sizeof($cliente_array)>0){
                $cliente = $cliente_array[0];
            }

        }

        return $cliente;
    }

    public function validarCantidadDigitosMobileByCode(){
        $mensajes = array();
        $lengthPhone = LENGTH_PHONE_DEFAULT;


        if(trim(strlen($this->getCliente_telefono())) != $lengthPhone){
            $mensajes[] = "El numero telefonico debe tener ".$lengthPhone." digitos";
        }

        return $mensajes;
    }

    public function validarMobileEnBD($client_id){
        $mensajes = array();

        if(Cliente::existeClientByTelefono($this->getCliente_telefono(), $client_id)){
            $mensajes[] = "El numero telefonico ya se encuentra registrado en " . Utility::getTextoAPP() .".";
        }

        return $mensajes;
    }

    public static function existeClientByTelefono($client_mobile, $client_id){

        global $pdo;


        $sql = "select c.cliente_id
                FROM cliente c
                WHERE c.cliente_telefono like '%".$client_mobile."%' and cliente_id != $client_id and cliente_estado = ".ACTIVO." limit 1 ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();
        if ($row) {
            return true;
        } else {
            return false;
        }
    }

    public static function totalUsuariosActivos(){
        global $pdo;



        $sqlWhere = "";
        $fechaFin = Utility::getFechaHoraActual();
        $fechaInicio = Utility::addTimeToDate($fechaFin, "-1 week");


        $sqlWhere .= " and (select count(*) from reserva where cliente_id = c.cliente_id and reserva_estado != ".CANCELADO." and reserva_fecha between '$fechaInicio' and '$fechaFin') > 0";

        $sql = "select count(*) as total
                FROM cliente c
                where cliente_estado = ".ACTIVO."
                ".$sqlWhere."  ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchColumn();
        if ($row) {
            return $row;
        } else {
            return 0;
        }
    }

    public function sendNotificacion($notificacion, $device_id = null){

        $array_dispositivos_android = Token::obtenerTokenDispositivosAndroid($this->cliente_id, $device_id);
        $array_dispositivos_ios = Token::obtenerTokenDispositivosiOS($this->cliente_id, $device_id);

        try{

            APS::enviarNotificacion($notificacion, $array_dispositivos_ios);
            FCM::enviarNotificacion($notificacion, $array_dispositivos_android);

            return true;

        }catch (Exception $er){

            return false;
        }
    }

    public static function getIdentificadorUnico(){
        $client = Cliente::getById(Security::getCurrentClienteId());

        if($client){
            if(!Utility::valorEstaVacio($client->cliente_numerodoc)){
                return $client->cliente_numerodoc;
            }else{
                return $client->cliente_id;
            }
        }

        return 9999999;

    }

    public static function getDiasNiubiz(){
        $client = Cliente::getById(Security::getCurrentClienteId());
        $fechaCliente = Utility::getFechaHoraActual();

        if($client){
            if(!Utility::valorEstaVacio($client->cliente_fecharegistro)){
                $fechaCliente =  $client->cliente_fecharegistro;
            }
        }

        return Utility::getDiferenciaDias($fechaCliente, Utility::getFechaHoraActual()) + 1;
    }

    public static function getClienteByID($cliente_id){

        $cliente = Cliente::getById($cliente_id);

        if($cliente){
            return $cliente->cliente_nombres . " " . $cliente->cliente_apellidos;
        }

        return null;

    }

    public static function reporteUsuarios($fechaInicio, $fechaFin,$pagina,$registros, $estado){
        global $pdo;

        $proveedor_vector = array();

        $sqlWhere = "";


        $sqlWhere .= " and (select count(*) from reserva where cliente_id = c.cliente_id and reserva_estado != ".CANCELADO." 
        and  reserva_fecha between '$fechaInicio' and '$fechaFin') > 0 ";

        $sql = "select SQL_CALC_FOUND_ROWS *, (select count(*) from reserva where cliente_id = c.cliente_id and reserva_estado != ".CANCELADO." 
        and  reserva_fecha between '$fechaInicio' and '$fechaFin') as total
                FROM cliente c
                where cliente_estado = ".ACTIVO."
                ".$sqlWhere."  group by c.cliente_id limit ".(($pagina-1)*$registros).",".$registros;

        //exit($sql);
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $result = $pdo->query("SELECT FOUND_ROWS() AS totalCount");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        while ($proveedor = $stmt->fetch()) {
            $proveedor_vector[] = $proveedor;
        }

        return array("cliente_array" => $proveedor_vector, "totalCount" => $row["totalCount"]);
    }

    public static function reporteUsuariosActivosInactivosPorProveedor($fechaInicio, $fechaFin,$pagina,$registros, $estado, $proveedor_id){
        global $pdo;

        $proveedor_vector = array();

        $sqlWhere = "";


        $sqlWhere .= " and (select count(*) from reserva where cliente_id = c.cliente_id and reserva_estado != ".CANCELADO." 
        and  reserva_fecha between '$fechaInicio' and '$fechaFin') > 0 ";

        $sql = "select SQL_CALC_FOUND_ROWS *, (select count(*) from reserva where cliente_id = c.cliente_id and reserva_estado != ".CANCELADO." 
        and  reserva_fecha between '$fechaInicio' and '$fechaFin') as total
                FROM cliente c inner join clienteproveedor cp on c.cliente_id = cp.cliente_id 
                where cliente_estado = ".ACTIVO."
                ".$sqlWhere."  group by c.cliente_id limit ".(($pagina-1)*$registros).",".$registros;

        //exit($sql);
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $result = $pdo->query("SELECT FOUND_ROWS() AS totalCount");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        while ($proveedor = $stmt->fetch()) {
            $proveedor_vector[] = $proveedor;
        }

        return array("cliente_array" => $proveedor_vector, "totalCount" => $row["totalCount"]);
    }
 }
?>