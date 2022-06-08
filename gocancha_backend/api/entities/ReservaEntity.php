<?php 
class ReservaEntity extends EntityBase implements DBOCrud { 
     function __construct($options = array()) { 
        parent::__construct($options);
    }
    public $reserva_id; 
    public $cliente_id; 
    public $cancha_id; 
    public $proveedor_id; 
    public $address_id; 
    public $platform_id; 
    public $reserva_fecha; 
    public $reserva_total; 
    public $reserva_precio; 
    public $reserva_fechaprogramacion; 
    public $reserva_horainicio; 
    public $reserva_horafin; 
    public $reserva_estado; 
    public $reserva_tipopago; 
    public $reserva_pagocon; 
    public $reserva_urlvoucher; 
    public $reserva_deviceid; 
    public $reserva_comision; 
    public $reserva_firstorder; 
    public $reserva_motivorechazo; 
    public $reserva_rating; 
    public $reserva_tipo; 
    public $reserva_cliente; 
    public $reserva_telefono; 
    public $reserva_canal; 

    public function getReserva_id(){ 
        return $this->reserva_id;
    }
    public function setReserva_id($reserva_id){ 
        $this->reserva_id = $reserva_id;
    }
    public function getCliente_id(){ 
        return $this->cliente_id;
    }
    public function setCliente_id($cliente_id){ 
        $this->cliente_id = $cliente_id;
    }
    public function getCancha_id(){ 
        return $this->cancha_id;
    }
    public function setCancha_id($cancha_id){ 
        $this->cancha_id = $cancha_id;
    }
    public function getProveedor_id(){ 
        return $this->proveedor_id;
    }
    public function setProveedor_id($proveedor_id){ 
        $this->proveedor_id = $proveedor_id;
    }
    public function getAddress_id(){ 
        return $this->address_id;
    }
    public function setAddress_id($address_id){ 
        $this->address_id = $address_id;
    }
    public function getPlatform_id(){ 
        return $this->platform_id;
    }
    public function setPlatform_id($platform_id){ 
        $this->platform_id = $platform_id;
    }
    public function getReserva_fecha(){ 
        return $this->reserva_fecha;
    }
    public function setReserva_fecha($reserva_fecha){ 
        $this->reserva_fecha = $reserva_fecha;
    }
    public function getReserva_total(){ 
        return $this->reserva_total;
    }
    public function setReserva_total($reserva_total){ 
        $this->reserva_total = $reserva_total;
    }
    public function getReserva_precio(){ 
        return $this->reserva_precio;
    }
    public function setReserva_precio($reserva_precio){ 
        $this->reserva_precio = $reserva_precio;
    }
    public function getReserva_fechaprogramacion(){ 
        return $this->reserva_fechaprogramacion;
    }
    public function setReserva_fechaprogramacion($reserva_fechaprogramacion){ 
        $this->reserva_fechaprogramacion = $reserva_fechaprogramacion;
    }
    public function getReserva_horainicio(){ 
        return $this->reserva_horainicio;
    }
    public function setReserva_horainicio($reserva_horainicio){ 
        $this->reserva_horainicio = $reserva_horainicio;
    }
    public function getReserva_horafin(){ 
        return $this->reserva_horafin;
    }
    public function setReserva_horafin($reserva_horafin){ 
        $this->reserva_horafin = $reserva_horafin;
    }
    public function getReserva_estado(){ 
        return $this->reserva_estado;
    }
    public function setReserva_estado($reserva_estado){ 
        $this->reserva_estado = $reserva_estado;
    }
    public function getReserva_tipopago(){ 
        return $this->reserva_tipopago;
    }
    public function setReserva_tipopago($reserva_tipopago){ 
        $this->reserva_tipopago = $reserva_tipopago;
    }
    public function getReserva_pagocon(){ 
        return $this->reserva_pagocon;
    }
    public function setReserva_pagocon($reserva_pagocon){ 
        $this->reserva_pagocon = $reserva_pagocon;
    }
    public function getReserva_urlvoucher(){ 
        return $this->reserva_urlvoucher;
    }
    public function setReserva_urlvoucher($reserva_urlvoucher){ 
        $this->reserva_urlvoucher = $reserva_urlvoucher;
    }
    public function getReserva_deviceid(){ 
        return $this->reserva_deviceid;
    }
    public function setReserva_deviceid($reserva_deviceid){ 
        $this->reserva_deviceid = $reserva_deviceid;
    }
    public function getReserva_comision(){ 
        return $this->reserva_comision;
    }
    public function setReserva_comision($reserva_comision){ 
        $this->reserva_comision = $reserva_comision;
    }
    public function getReserva_firstorder(){ 
        return $this->reserva_firstorder;
    }
    public function setReserva_firstorder($reserva_firstorder){ 
        $this->reserva_firstorder = $reserva_firstorder;
    }
    public function getReserva_motivorechazo(){ 
        return $this->reserva_motivorechazo;
    }
    public function setReserva_motivorechazo($reserva_motivorechazo){ 
        $this->reserva_motivorechazo = $reserva_motivorechazo;
    }
    public function getReserva_rating(){ 
        return $this->reserva_rating;
    }
    public function setReserva_rating($reserva_rating){ 
        $this->reserva_rating = $reserva_rating;
    }
    public function getReserva_tipo(){ 
        return $this->reserva_tipo;
    }
    public function setReserva_tipo($reserva_tipo){ 
        $this->reserva_tipo = $reserva_tipo;
    }
    public function getReserva_cliente(){ 
        return $this->reserva_cliente;
    }
    public function setReserva_cliente($reserva_cliente){ 
        $this->reserva_cliente = $reserva_cliente;
    }
    public function getReserva_telefono(){ 
        return $this->reserva_telefono;
    }
    public function setReserva_telefono($reserva_telefono){ 
        $this->reserva_telefono = $reserva_telefono;
    }
    public function getReserva_canal(){ 
        return $this->reserva_canal;
    }
    public function setReserva_canal($reserva_canal){ 
        $this->reserva_canal = $reserva_canal;
    }
 
    public function insert(){
    	try {
    		global $pdo;
    		$query = '';
    		$query2 = '';
    		if(isset($this->reserva_id))
    			$query.='reserva_id, ';
    		if(isset($this->cliente_id))
    			$query.='cliente_id, ';
    		if(isset($this->cancha_id))
    			$query.='cancha_id, ';
    		if(isset($this->proveedor_id))
    			$query.='proveedor_id, ';
    		if(isset($this->address_id))
    			$query.='address_id, ';
    		if(isset($this->platform_id))
    			$query.='platform_id, ';
    		if(isset($this->reserva_fecha))
    			$query.='reserva_fecha, ';
    		if(isset($this->reserva_total))
    			$query.='reserva_total, ';
    		if(isset($this->reserva_precio))
    			$query.='reserva_precio, ';
    		if(isset($this->reserva_fechaprogramacion))
    			$query.='reserva_fechaprogramacion, ';
    		if(isset($this->reserva_horainicio))
    			$query.='reserva_horainicio, ';
    		if(isset($this->reserva_horafin))
    			$query.='reserva_horafin, ';
    		if(isset($this->reserva_estado))
    			$query.='reserva_estado, ';
    		if(isset($this->reserva_tipopago))
    			$query.='reserva_tipopago, ';
    		if(isset($this->reserva_pagocon))
    			$query.='reserva_pagocon, ';
    		if(isset($this->reserva_urlvoucher))
    			$query.='reserva_urlvoucher, ';
    		if(isset($this->reserva_deviceid))
    			$query.='reserva_deviceid, ';
    		if(isset($this->reserva_comision))
    			$query.='reserva_comision, ';
    		if(isset($this->reserva_firstorder))
    			$query.='reserva_firstorder, ';
    		if(isset($this->reserva_motivorechazo))
    			$query.='reserva_motivorechazo, ';
    		if(isset($this->reserva_rating))
    			$query.='reserva_rating, ';
    		if(isset($this->reserva_tipo))
    			$query.='reserva_tipo, ';
    		if(isset($this->reserva_cliente))
    			$query.='reserva_cliente, ';
    		if(isset($this->reserva_telefono))
    			$query.='reserva_telefono, ';
    		if(isset($this->reserva_canal))
    			$query.='reserva_canal, ';
    		if(isset($this->reserva_id))
    			$query2.=':reserva_id, ';
    		if(isset($this->cliente_id))
    			$query2.=':cliente_id, ';
    		if(isset($this->cancha_id))
    			$query2.=':cancha_id, ';
    		if(isset($this->proveedor_id))
    			$query2.=':proveedor_id, ';
    		if(isset($this->address_id))
    			$query2.=':address_id, ';
    		if(isset($this->platform_id))
    			$query2.=':platform_id, ';
    		if(isset($this->reserva_fecha))
    			$query2.=':reserva_fecha, ';
    		if(isset($this->reserva_total))
    			$query2.=':reserva_total, ';
    		if(isset($this->reserva_precio))
    			$query2.=':reserva_precio, ';
    		if(isset($this->reserva_fechaprogramacion))
    			$query2.=':reserva_fechaprogramacion, ';
    		if(isset($this->reserva_horainicio))
    			$query2.=':reserva_horainicio, ';
    		if(isset($this->reserva_horafin))
    			$query2.=':reserva_horafin, ';
    		if(isset($this->reserva_estado))
    			$query2.=':reserva_estado, ';
    		if(isset($this->reserva_tipopago))
    			$query2.=':reserva_tipopago, ';
    		if(isset($this->reserva_pagocon))
    			$query2.=':reserva_pagocon, ';
    		if(isset($this->reserva_urlvoucher))
    			$query2.=':reserva_urlvoucher, ';
    		if(isset($this->reserva_deviceid))
    			$query2.=':reserva_deviceid, ';
    		if(isset($this->reserva_comision))
    			$query2.=':reserva_comision, ';
    		if(isset($this->reserva_firstorder))
    			$query2.=':reserva_firstorder, ';
    		if(isset($this->reserva_motivorechazo))
    			$query2.=':reserva_motivorechazo, ';
    		if(isset($this->reserva_rating))
    			$query2.=':reserva_rating, ';
    		if(isset($this->reserva_tipo))
    			$query2.=':reserva_tipo, ';
    		if(isset($this->reserva_cliente))
    			$query2.=':reserva_cliente, ';
    		if(isset($this->reserva_telefono))
    			$query2.=':reserva_telefono, ';
    		if(isset($this->reserva_canal))
    			$query2.=':reserva_canal, ';
    		$query = substr($query, 0, strlen($query) - 2);
    		$query2 = substr($query2, 0, strlen($query2) - 2);

    		$stmt = $pdo->prepare('INSERT INTO reserva('.$query.') VALUES('.$query2.')');

    		if(isset($this->reserva_id))
    			$stmt->bindParam(':reserva_id',	$this->reserva_id,	PDO::PARAM_STR);
    		if(isset($this->cliente_id))
    			$stmt->bindParam(':cliente_id',	$this->cliente_id,	PDO::PARAM_STR);
    		if(isset($this->cancha_id))
    			$stmt->bindParam(':cancha_id',	$this->cancha_id,	PDO::PARAM_STR);
    		if(isset($this->proveedor_id))
    			$stmt->bindParam(':proveedor_id',	$this->proveedor_id,	PDO::PARAM_STR);
    		if(isset($this->address_id))
    			$stmt->bindParam(':address_id',	$this->address_id,	PDO::PARAM_STR);
    		if(isset($this->platform_id))
    			$stmt->bindParam(':platform_id',	$this->platform_id,	PDO::PARAM_STR);
    		if(isset($this->reserva_fecha))
    			$stmt->bindParam(':reserva_fecha',	$this->reserva_fecha,	PDO::PARAM_STR);
    		if(isset($this->reserva_total))
    			$stmt->bindParam(':reserva_total',	$this->reserva_total,	PDO::PARAM_STR);
    		if(isset($this->reserva_precio))
    			$stmt->bindParam(':reserva_precio',	$this->reserva_precio,	PDO::PARAM_STR);
    		if(isset($this->reserva_fechaprogramacion))
    			$stmt->bindParam(':reserva_fechaprogramacion',	$this->reserva_fechaprogramacion,	PDO::PARAM_STR);
    		if(isset($this->reserva_horainicio))
    			$stmt->bindParam(':reserva_horainicio',	$this->reserva_horainicio,	PDO::PARAM_STR);
    		if(isset($this->reserva_horafin))
    			$stmt->bindParam(':reserva_horafin',	$this->reserva_horafin,	PDO::PARAM_STR);
    		if(isset($this->reserva_estado))
    			$stmt->bindParam(':reserva_estado',	$this->reserva_estado,	PDO::PARAM_STR);
    		if(isset($this->reserva_tipopago))
    			$stmt->bindParam(':reserva_tipopago',	$this->reserva_tipopago,	PDO::PARAM_STR);
    		if(isset($this->reserva_pagocon))
    			$stmt->bindParam(':reserva_pagocon',	$this->reserva_pagocon,	PDO::PARAM_STR);
    		if(isset($this->reserva_urlvoucher))
    			$stmt->bindParam(':reserva_urlvoucher',	$this->reserva_urlvoucher,	PDO::PARAM_STR);
    		if(isset($this->reserva_deviceid))
    			$stmt->bindParam(':reserva_deviceid',	$this->reserva_deviceid,	PDO::PARAM_STR);
    		if(isset($this->reserva_comision))
    			$stmt->bindParam(':reserva_comision',	$this->reserva_comision,	PDO::PARAM_STR);
    		if(isset($this->reserva_firstorder))
    			$stmt->bindParam(':reserva_firstorder',	$this->reserva_firstorder,	PDO::PARAM_STR);
    		if(isset($this->reserva_motivorechazo))
    			$stmt->bindParam(':reserva_motivorechazo',	$this->reserva_motivorechazo,	PDO::PARAM_STR);
    		if(isset($this->reserva_rating))
    			$stmt->bindParam(':reserva_rating',	$this->reserva_rating,	PDO::PARAM_STR);
    		if(isset($this->reserva_tipo))
    			$stmt->bindParam(':reserva_tipo',	$this->reserva_tipo,	PDO::PARAM_STR);
    		if(isset($this->reserva_cliente))
    			$stmt->bindParam(':reserva_cliente',	$this->reserva_cliente,	PDO::PARAM_STR);
    		if(isset($this->reserva_telefono))
    			$stmt->bindParam(':reserva_telefono',	$this->reserva_telefono,	PDO::PARAM_STR);
    		if(isset($this->reserva_canal))
    			$stmt->bindParam(':reserva_canal',	$this->reserva_canal,	PDO::PARAM_STR);
    		$stmt->execute();
    		if($stmt->rowCount() === 1){
    			$id = $pdo->lastInsertId();
    			$this->reserva_id = $id;
    			return $id;
    		}else{
    			return false;
    		}
    	} catch (PDOException $e) {
    		echo 'Error: ' . $e->getMessage() . '\n'. $e->getTraceAsString();
    		Utility::capture($e);
    	}
    }

 
    public function update(){
    	try {
    		global $pdo;
    		$query='UPDATE reserva SET ';
    		if(isset($this->cliente_id))
    			$query.='cliente_id=:cliente_id, ';
    		if(isset($this->cancha_id))
    			$query.='cancha_id=:cancha_id, ';
    		if(isset($this->proveedor_id))
    			$query.='proveedor_id=:proveedor_id, ';
    		if(isset($this->address_id))
    			$query.='address_id=:address_id, ';
    		if(isset($this->platform_id))
    			$query.='platform_id=:platform_id, ';
    		if(isset($this->reserva_fecha))
    			$query.='reserva_fecha=:reserva_fecha, ';
    		if(isset($this->reserva_total))
    			$query.='reserva_total=:reserva_total, ';
    		if(isset($this->reserva_precio))
    			$query.='reserva_precio=:reserva_precio, ';
    		if(isset($this->reserva_fechaprogramacion))
    			$query.='reserva_fechaprogramacion=:reserva_fechaprogramacion, ';
    		if(isset($this->reserva_horainicio))
    			$query.='reserva_horainicio=:reserva_horainicio, ';
    		if(isset($this->reserva_horafin))
    			$query.='reserva_horafin=:reserva_horafin, ';
    		if(isset($this->reserva_estado))
    			$query.='reserva_estado=:reserva_estado, ';
    		if(isset($this->reserva_tipopago))
    			$query.='reserva_tipopago=:reserva_tipopago, ';
    		if(isset($this->reserva_pagocon))
    			$query.='reserva_pagocon=:reserva_pagocon, ';
    		if(isset($this->reserva_urlvoucher))
    			$query.='reserva_urlvoucher=:reserva_urlvoucher, ';
    		if(isset($this->reserva_deviceid))
    			$query.='reserva_deviceid=:reserva_deviceid, ';
    		if(isset($this->reserva_comision))
    			$query.='reserva_comision=:reserva_comision, ';
    		if(isset($this->reserva_firstorder))
    			$query.='reserva_firstorder=:reserva_firstorder, ';
    		if(isset($this->reserva_motivorechazo))
    			$query.='reserva_motivorechazo=:reserva_motivorechazo, ';
    		if(isset($this->reserva_rating))
    			$query.='reserva_rating=:reserva_rating, ';
    		if(isset($this->reserva_tipo))
    			$query.='reserva_tipo=:reserva_tipo, ';
    		if(isset($this->reserva_cliente))
    			$query.='reserva_cliente=:reserva_cliente, ';
    		if(isset($this->reserva_telefono))
    			$query.='reserva_telefono=:reserva_telefono, ';
    		if(isset($this->reserva_canal))
    			$query.='reserva_canal=:reserva_canal, ';

    		if($query!='UPDATE reserva SET ')
    			$query = substr($query, 0, strlen($query) - 2);
    		$query.=' WHERE reserva_id=:reserva_id';
    		$stmt = $pdo->prepare($query);

    		$stmt->bindParam(':reserva_id',	$this->reserva_id,	PDO::PARAM_STR);

    		if(isset($this->cliente_id))
    			$stmt->bindParam(':cliente_id',	$this->cliente_id,	PDO::PARAM_STR);
    		if(isset($this->cancha_id))
    			$stmt->bindParam(':cancha_id',	$this->cancha_id,	PDO::PARAM_STR);
    		if(isset($this->proveedor_id))
    			$stmt->bindParam(':proveedor_id',	$this->proveedor_id,	PDO::PARAM_STR);
    		if(isset($this->address_id))
    			$stmt->bindParam(':address_id',	$this->address_id,	PDO::PARAM_STR);
    		if(isset($this->platform_id))
    			$stmt->bindParam(':platform_id',	$this->platform_id,	PDO::PARAM_STR);
    		if(isset($this->reserva_fecha))
    			$stmt->bindParam(':reserva_fecha',	$this->reserva_fecha,	PDO::PARAM_STR);
    		if(isset($this->reserva_total))
    			$stmt->bindParam(':reserva_total',	$this->reserva_total,	PDO::PARAM_STR);
    		if(isset($this->reserva_precio))
    			$stmt->bindParam(':reserva_precio',	$this->reserva_precio,	PDO::PARAM_STR);
    		if(isset($this->reserva_fechaprogramacion))
    			$stmt->bindParam(':reserva_fechaprogramacion',	$this->reserva_fechaprogramacion,	PDO::PARAM_STR);
    		if(isset($this->reserva_horainicio))
    			$stmt->bindParam(':reserva_horainicio',	$this->reserva_horainicio,	PDO::PARAM_STR);
    		if(isset($this->reserva_horafin))
    			$stmt->bindParam(':reserva_horafin',	$this->reserva_horafin,	PDO::PARAM_STR);
    		if(isset($this->reserva_estado))
    			$stmt->bindParam(':reserva_estado',	$this->reserva_estado,	PDO::PARAM_STR);
    		if(isset($this->reserva_tipopago))
    			$stmt->bindParam(':reserva_tipopago',	$this->reserva_tipopago,	PDO::PARAM_STR);
    		if(isset($this->reserva_pagocon))
    			$stmt->bindParam(':reserva_pagocon',	$this->reserva_pagocon,	PDO::PARAM_STR);
    		if(isset($this->reserva_urlvoucher))
    			$stmt->bindParam(':reserva_urlvoucher',	$this->reserva_urlvoucher,	PDO::PARAM_STR);
    		if(isset($this->reserva_deviceid))
    			$stmt->bindParam(':reserva_deviceid',	$this->reserva_deviceid,	PDO::PARAM_STR);
    		if(isset($this->reserva_comision))
    			$stmt->bindParam(':reserva_comision',	$this->reserva_comision,	PDO::PARAM_STR);
    		if(isset($this->reserva_firstorder))
    			$stmt->bindParam(':reserva_firstorder',	$this->reserva_firstorder,	PDO::PARAM_STR);
    		if(isset($this->reserva_motivorechazo))
    			$stmt->bindParam(':reserva_motivorechazo',	$this->reserva_motivorechazo,	PDO::PARAM_STR);
    		if(isset($this->reserva_rating))
    			$stmt->bindParam(':reserva_rating',	$this->reserva_rating,	PDO::PARAM_STR);
    		if(isset($this->reserva_tipo))
    			$stmt->bindParam(':reserva_tipo',	$this->reserva_tipo,	PDO::PARAM_STR);
    		if(isset($this->reserva_cliente))
    			$stmt->bindParam(':reserva_cliente',	$this->reserva_cliente,	PDO::PARAM_STR);
    		if(isset($this->reserva_telefono))
    			$stmt->bindParam(':reserva_telefono',	$this->reserva_telefono,	PDO::PARAM_STR);
    		if(isset($this->reserva_canal))
    			$stmt->bindParam(':reserva_canal',	$this->reserva_canal,	PDO::PARAM_STR);
    		return $stmt->execute();
    	} catch (PDOException $e) {
    		echo 'Error: ' . $e->getMessage();
    		Utility::capture($e);
    	}
    }

 
    public function delete(){
    	try {
    		global $pdo;
    		$sql = 'DELETE FROM reserva WHERE reserva_id=:reserva_id';
    		$stmt = $pdo->prepare($sql);
    		$stmt->bindParam(':reserva_id',$this->reserva_id, PDO::PARAM_STR);
    		$stmt->execute();
    		return $stmt->rowCount();
    	} catch (Exception $exc) {
    		echo $exc->getTraceAsString();
    		Utility::capture($exc);
    	}
    }
 
    public static function getById($reserva_id){
    	global $pdo;
    	$sql = 'SELECT * FROM reserva WHERE reserva_id=:reserva_id';
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':reserva_id',$reserva_id, PDO::PARAM_STR);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	if($row){
    		return new Reserva($row);
    	}else{
    		return false;
      }
    }
 
    public static function getList($orderParams = array(), $start = 0, $limit = LIMIT_RESULT) {
 	  	return self::getByFields(array(), $orderParams, $start, $limit);
 	  }
 
    public static function getByFields($whereParams = array(),  $orderParams = array(), $start = 0, $limit = LIMIT_RESULT){
 	  try{
 	  	global $pdo;
 	  	$tbases_vector = array();
 	  	$orderClause = '';
 	  	if(count($orderParams)>0){
 	  		$arrOrderParams = array();
 	  		foreach ($orderParams as $op){
 	  			$arrOrderParams[] = sprintf('%s %s', $op['field'], $op['order']);
 	  		}
 	  	$orderClause = ' ORDER by '. join(', ', $arrOrderParams);
 	  }else{
 	  	$orderClause = ' ORDER by reserva_id';
 	  }
 	  $whereClause = '';
 	  if(count($whereParams)>0){
 	  	$arrWhereParams = array();
 	  	foreach($whereParams as $wp){
 	  		if (isset($wp['conditional'])) {
 	  			if ($wp['conditional'] == '' || $wp['conditional'] == NULL) {
 	  				$conditional = 'and';
 	  			} else {
 	  			switch(strtolower(trim($wp['conditional'],' '))){
 	  				case 'and':
 	  					$conditional = 'and';break;
 	  				case 'or':
 	  					$conditional = 'or';break;
 	  				default :
 	  					$conditional = 'and';
 	  				}
 	  			}
 	  		} else {
 	  			$conditional = 'and';
 	  		}
 	  		$whereClause .= sprintf(' %s %s :%s %s', $wp['field'], $wp['operator'], $wp['field'],$conditional);
 	  	}
 	  		$whereClause = trim($whereClause,'and');
 	  		$whereClause = trim($whereClause,'or');
 	  		$whereClause = ' where '.$whereClause;
 	  	}
 	  	$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM reserva '.$whereClause .' '.$orderClause.' ';
 	  		if($limit!=0){
 	  		$query.=' LIMIT :start, :limit';
 	  		}
 	  	$stmt = $pdo->prepare($query);
 	  	if(count($whereParams)>0){
 	  		foreach($whereParams as $wp){
 	  		$stmt->bindParam(':'.$wp['field'], $wp['value']);
 	  		}
 	  	}
 	  	$start = (int)$start;
 	  	$limit = (int)$limit;
 	  		if($limit!=0){
 	  			$stmt->bindParam(':start', $start, PDO::PARAM_INT);
 	  			$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
 	  		}
 	  	$stmt->execute();
 	  	$stmt->setFetchMode(PDO::FETCH_CLASS, 'ReservaEntity');
 	  	$result = $pdo->query('SELECT FOUND_ROWS() AS totalCount');
 	  	$result->setFetchMode(PDO::FETCH_ASSOC);
 	  	$row = $result->fetch();
 	  	$tbases = array();
 	  	while($tbases = $stmt->fetch()){
 	  		$tbases_vector[] = $tbases;
 	  	}
 	  	return array('reserva_array' =>$tbases_vector, 'totalCount'=>$row['totalCount']);
 	  	} catch (Exception $exc) {
 	  		echo $exc->getTraceAsString();
    		Utility::capture($exc);
 	  	}
 	  }
 
    public static function getTotalRows(){
    	$total_rows = 0;
    	try {
    		global $pdo;
    		$sql = 'select count(*) from  reserva';
    		$stmt = $pdo->query($sql);
    		$stmt->execute();
    		if($row = $stmt->fetch()){
    			$total_rows = $row[0];
    		}
    	} catch (Exception $exc) {
    		$total_rows = 0;
    	}
    	return $total_rows;
    }
 
    public static function findWithQuery($query, $params = array()){
    	global $pdo;
    	$stmt = $pdo->prepare($query);
    	for($i = 0 ; $i < sizeof($params) ; $i++){
    		$stmt->bindValue($i+1, $params[$i]);
    	}
    	$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Reserva');
		$salida_vector = array();
		while ($obj = $stmt->fetch()) {
			$salida_vector[] = $obj;
		}
		return $salida_vector;
    }
}
?>