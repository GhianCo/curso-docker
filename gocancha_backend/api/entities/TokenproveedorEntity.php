<?php 
class TokenproveedorEntity extends EntityBase implements DBOCrud { 
     function __construct($options = array()) { 
        parent::__construct($options);
    }
    public $tokenproveedor_id; 
    public $login_id; 
    public $platform_id; 
    public $tokenproveedor_valor; 
    public $tokenproveedor_fcm; 
    public $tokenproveedor_debeexpirar; 
    public $tokenproveedor_deviceid; 
    public $tokenproveedor_device; 
    public $tokenproveedor_fecha; 
    public $tokenproveedor_fechaexpiracion; 
    public $tokenproveedor_version; 
    public $tokenproveedor_estado; 
    public $tokenproveedor_ultimoacceso;

    public function getTokenproveedor_id(){ 
        return $this->tokenproveedor_id;
    }
    public function setTokenproveedor_id($tokenproveedor_id){ 
        $this->tokenproveedor_id = $tokenproveedor_id;
    }
    public function getLogin_id(){ 
        return $this->login_id;
    }
    public function setLogin_id($login_id){ 
        $this->login_id = $login_id;
    }
    public function getPlatform_id(){ 
        return $this->platform_id;
    }
    public function setPlatform_id($platform_id){ 
        $this->platform_id = $platform_id;
    }
    public function getTokenproveedor_valor(){ 
        return $this->tokenproveedor_valor;
    }
    public function setTokenproveedor_valor($tokenproveedor_valor){ 
        $this->tokenproveedor_valor = $tokenproveedor_valor;
    }
    public function getTokenproveedor_fcm(){ 
        return $this->tokenproveedor_fcm;
    }
    public function setTokenproveedor_fcm($tokenproveedor_fcm){ 
        $this->tokenproveedor_fcm = $tokenproveedor_fcm;
    }
    public function getTokenproveedor_debeexpirar(){ 
        return $this->tokenproveedor_debeexpirar;
    }
    public function setTokenproveedor_debeexpirar($tokenproveedor_debeexpirar){ 
        $this->tokenproveedor_debeexpirar = $tokenproveedor_debeexpirar;
    }
    public function getTokenproveedor_deviceid(){ 
        return $this->tokenproveedor_deviceid;
    }
    public function setTokenproveedor_deviceid($tokenproveedor_deviceid){ 
        $this->tokenproveedor_deviceid = $tokenproveedor_deviceid;
    }
    public function getTokenproveedor_device(){ 
        return $this->tokenproveedor_device;
    }
    public function setTokenproveedor_device($tokenproveedor_device){ 
        $this->tokenproveedor_device = $tokenproveedor_device;
    }
    public function getTokenproveedor_fecha(){ 
        return $this->tokenproveedor_fecha;
    }
    public function setTokenproveedor_fecha($tokenproveedor_fecha){ 
        $this->tokenproveedor_fecha = $tokenproveedor_fecha;
    }
    public function getTokenproveedor_fechaexpiracion(){ 
        return $this->tokenproveedor_fechaexpiracion;
    }
    public function setTokenproveedor_fechaexpiracion($tokenproveedor_fechaexpiracion){ 
        $this->tokenproveedor_fechaexpiracion = $tokenproveedor_fechaexpiracion;
    }
    public function getTokenproveedor_version(){ 
        return $this->tokenproveedor_version;
    }
    public function setTokenproveedor_version($tokenproveedor_version){ 
        $this->tokenproveedor_version = $tokenproveedor_version;
    }
    public function getTokenproveedor_estado(){ 
        return $this->tokenproveedor_estado;
    }
    public function setTokenproveedor_estado($tokenproveedor_estado){ 
        $this->tokenproveedor_estado = $tokenproveedor_estado;
    }
 
    public function insert(){
    	try {
    		global $pdo;
    		$query = '';
    		$query2 = '';
    		if(isset($this->tokenproveedor_id))
    			$query.='tokenproveedor_id, ';
    		if(isset($this->login_id))
    			$query.='login_id, ';
    		if(isset($this->platform_id))
    			$query.='platform_id, ';
    		if(isset($this->tokenproveedor_valor))
    			$query.='tokenproveedor_valor, ';
    		if(isset($this->tokenproveedor_fcm))
    			$query.='tokenproveedor_fcm, ';
    		if(isset($this->tokenproveedor_debeexpirar))
    			$query.='tokenproveedor_debeexpirar, ';
    		if(isset($this->tokenproveedor_deviceid))
    			$query.='tokenproveedor_deviceid, ';
    		if(isset($this->tokenproveedor_device))
    			$query.='tokenproveedor_device, ';
    		if(isset($this->tokenproveedor_fecha))
    			$query.='tokenproveedor_fecha, ';
    		if(isset($this->tokenproveedor_fechaexpiracion))
    			$query.='tokenproveedor_fechaexpiracion, ';
    		if(isset($this->tokenproveedor_version))
    			$query.='tokenproveedor_version, ';
    		if(isset($this->tokenproveedor_estado))
    			$query.='tokenproveedor_estado, ';
    		if(isset($this->tokenproveedor_ultimoacceso))
    			$query.='tokenproveedor_ultimoacceso, ';
    		if(isset($this->tokenproveedor_id))
    			$query2.=':tokenproveedor_id, ';
    		if(isset($this->login_id))
    			$query2.=':login_id, ';
    		if(isset($this->platform_id))
    			$query2.=':platform_id, ';
    		if(isset($this->tokenproveedor_valor))
    			$query2.=':tokenproveedor_valor, ';
    		if(isset($this->tokenproveedor_fcm))
    			$query2.=':tokenproveedor_fcm, ';
    		if(isset($this->tokenproveedor_debeexpirar))
    			$query2.=':tokenproveedor_debeexpirar, ';
    		if(isset($this->tokenproveedor_deviceid))
    			$query2.=':tokenproveedor_deviceid, ';
    		if(isset($this->tokenproveedor_device))
    			$query2.=':tokenproveedor_device, ';
    		if(isset($this->tokenproveedor_fecha))
    			$query2.=':tokenproveedor_fecha, ';
    		if(isset($this->tokenproveedor_fechaexpiracion))
    			$query2.=':tokenproveedor_fechaexpiracion, ';
    		if(isset($this->tokenproveedor_version))
    			$query2.=':tokenproveedor_version, ';
    		if(isset($this->tokenproveedor_estado))
    			$query2.=':tokenproveedor_estado, ';
    		if(isset($this->tokenproveedor_ultimoacceso))
    			$query2.=':tokenproveedor_ultimoacceso, ';
    		$query = substr($query, 0, strlen($query) - 2);
    		$query2 = substr($query2, 0, strlen($query2) - 2);

    		$stmt = $pdo->prepare('INSERT INTO tokenproveedor('.$query.') VALUES('.$query2.')');

    		if(isset($this->tokenproveedor_id))
    			$stmt->bindParam(':tokenproveedor_id',	$this->tokenproveedor_id,	PDO::PARAM_STR);
    		if(isset($this->login_id))
    			$stmt->bindParam(':login_id',	$this->login_id,	PDO::PARAM_STR);
    		if(isset($this->platform_id))
    			$stmt->bindParam(':platform_id',	$this->platform_id,	PDO::PARAM_STR);
    		if(isset($this->tokenproveedor_valor))
    			$stmt->bindParam(':tokenproveedor_valor',	$this->tokenproveedor_valor,	PDO::PARAM_STR);
    		if(isset($this->tokenproveedor_fcm))
    			$stmt->bindParam(':tokenproveedor_fcm',	$this->tokenproveedor_fcm,	PDO::PARAM_STR);
    		if(isset($this->tokenproveedor_debeexpirar))
    			$stmt->bindParam(':tokenproveedor_debeexpirar',	$this->tokenproveedor_debeexpirar,	PDO::PARAM_STR);
    		if(isset($this->tokenproveedor_deviceid))
    			$stmt->bindParam(':tokenproveedor_deviceid',	$this->tokenproveedor_deviceid,	PDO::PARAM_STR);
    		if(isset($this->tokenproveedor_device))
    			$stmt->bindParam(':tokenproveedor_device',	$this->tokenproveedor_device,	PDO::PARAM_STR);
    		if(isset($this->tokenproveedor_fecha))
    			$stmt->bindParam(':tokenproveedor_fecha',	$this->tokenproveedor_fecha,	PDO::PARAM_STR);
    		if(isset($this->tokenproveedor_fechaexpiracion))
    			$stmt->bindParam(':tokenproveedor_fechaexpiracion',	$this->tokenproveedor_fechaexpiracion,	PDO::PARAM_STR);
    		if(isset($this->tokenproveedor_version))
    			$stmt->bindParam(':tokenproveedor_version',	$this->tokenproveedor_version,	PDO::PARAM_STR);
    		if(isset($this->tokenproveedor_estado))
    			$stmt->bindParam(':tokenproveedor_estado',	$this->tokenproveedor_estado,	PDO::PARAM_STR);
    		if(isset($this->tokenproveedor_ultimoacceso))
    			$stmt->bindParam(':tokenproveedor_ultimoacceso',	$this->tokenproveedor_ultimoacceso,	PDO::PARAM_STR);
    		$stmt->execute();
    		if($stmt->rowCount() === 1){
    			$id = $pdo->lastInsertId();
    			$this->tokenproveedor_id = $id;
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
    		$query='UPDATE tokenproveedor SET ';
    		if(isset($this->login_id))
    			$query.='login_id=:login_id, ';
    		if(isset($this->platform_id))
    			$query.='platform_id=:platform_id, ';
    		if(isset($this->tokenproveedor_valor))
    			$query.='tokenproveedor_valor=:tokenproveedor_valor, ';
    		if(isset($this->tokenproveedor_fcm))
    			$query.='tokenproveedor_fcm=:tokenproveedor_fcm, ';
    		if(isset($this->tokenproveedor_debeexpirar))
    			$query.='tokenproveedor_debeexpirar=:tokenproveedor_debeexpirar, ';
    		if(isset($this->tokenproveedor_deviceid))
    			$query.='tokenproveedor_deviceid=:tokenproveedor_deviceid, ';
    		if(isset($this->tokenproveedor_device))
    			$query.='tokenproveedor_device=:tokenproveedor_device, ';
    		if(isset($this->tokenproveedor_fecha))
    			$query.='tokenproveedor_fecha=:tokenproveedor_fecha, ';
    		if(isset($this->tokenproveedor_fechaexpiracion))
    			$query.='tokenproveedor_fechaexpiracion=:tokenproveedor_fechaexpiracion, ';
    		if(isset($this->tokenproveedor_version))
    			$query.='tokenproveedor_version=:tokenproveedor_version, ';
    		if(isset($this->tokenproveedor_estado))
    			$query.='tokenproveedor_estado=:tokenproveedor_estado, ';
    		if(isset($this->tokenproveedor_ultimoacceso))
    			$query.='tokenproveedor_ultimoacceso=:tokenproveedor_ultimoacceso, ';

    		if($query!='UPDATE tokenproveedor SET ')
    			$query = substr($query, 0, strlen($query) - 2);
    		$query.=' WHERE tokenproveedor_id=:tokenproveedor_id';
    		$stmt = $pdo->prepare($query);

    		$stmt->bindParam(':tokenproveedor_id',	$this->tokenproveedor_id,	PDO::PARAM_STR);

    		if(isset($this->login_id))
    			$stmt->bindParam(':login_id',	$this->login_id,	PDO::PARAM_STR);
    		if(isset($this->platform_id))
    			$stmt->bindParam(':platform_id',	$this->platform_id,	PDO::PARAM_STR);
    		if(isset($this->tokenproveedor_valor))
    			$stmt->bindParam(':tokenproveedor_valor',	$this->tokenproveedor_valor,	PDO::PARAM_STR);
    		if(isset($this->tokenproveedor_fcm))
    			$stmt->bindParam(':tokenproveedor_fcm',	$this->tokenproveedor_fcm,	PDO::PARAM_STR);
    		if(isset($this->tokenproveedor_debeexpirar))
    			$stmt->bindParam(':tokenproveedor_debeexpirar',	$this->tokenproveedor_debeexpirar,	PDO::PARAM_STR);
    		if(isset($this->tokenproveedor_deviceid))
    			$stmt->bindParam(':tokenproveedor_deviceid',	$this->tokenproveedor_deviceid,	PDO::PARAM_STR);
    		if(isset($this->tokenproveedor_device))
    			$stmt->bindParam(':tokenproveedor_device',	$this->tokenproveedor_device,	PDO::PARAM_STR);
    		if(isset($this->tokenproveedor_fecha))
    			$stmt->bindParam(':tokenproveedor_fecha',	$this->tokenproveedor_fecha,	PDO::PARAM_STR);
    		if(isset($this->tokenproveedor_fechaexpiracion))
    			$stmt->bindParam(':tokenproveedor_fechaexpiracion',	$this->tokenproveedor_fechaexpiracion,	PDO::PARAM_STR);
    		if(isset($this->tokenproveedor_version))
    			$stmt->bindParam(':tokenproveedor_version',	$this->tokenproveedor_version,	PDO::PARAM_STR);
    		if(isset($this->tokenproveedor_estado))
    			$stmt->bindParam(':tokenproveedor_estado',	$this->tokenproveedor_estado,	PDO::PARAM_STR);
    		if(isset($this->tokenproveedor_ultimoacceso))
    			$stmt->bindParam(':tokenproveedor_ultimoacceso',	$this->tokenproveedor_ultimoacceso,	PDO::PARAM_STR);
    		return $stmt->execute();
    	} catch (PDOException $e) {
    		echo 'Error: ' . $e->getMessage();
    		Utility::capture($e);
    	}
    }

 
    public function delete(){
    	try {
    		global $pdo;
    		$sql = 'DELETE FROM tokenproveedor WHERE tokenproveedor_id=:tokenproveedor_id';
    		$stmt = $pdo->prepare($sql);
    		$stmt->bindParam(':tokenproveedor_id',$this->tokenproveedor_id, PDO::PARAM_STR);
    		$stmt->execute();
    		return $stmt->rowCount();
    	} catch (Exception $exc) {
    		echo $exc->getTraceAsString();
    		Utility::capture($exc);
    	}
    }
 
    public static function getById($tokenproveedor_id){
    	global $pdo;
    	$sql = 'SELECT * FROM tokenproveedor WHERE tokenproveedor_id=:tokenproveedor_id';
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':tokenproveedor_id',$tokenproveedor_id, PDO::PARAM_STR);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	if($row){
    		return new Tokenproveedor($row);
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
 	  	$orderClause = ' ORDER by tokenproveedor_id';
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
 	  	$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM tokenproveedor '.$whereClause .' '.$orderClause.' ';
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
 	  	$stmt->setFetchMode(PDO::FETCH_CLASS, 'TokenproveedorEntity');
 	  	$result = $pdo->query('SELECT FOUND_ROWS() AS totalCount');
 	  	$result->setFetchMode(PDO::FETCH_ASSOC);
 	  	$row = $result->fetch();
 	  	$tbases = array();
 	  	while($tbases = $stmt->fetch()){
 	  		$tbases_vector[] = $tbases;
 	  	}
 	  	return array('tokenproveedor_array' =>$tbases_vector, 'totalCount'=>$row['totalCount']);
 	  	} catch (Exception $exc) {
 	  		echo $exc->getTraceAsString();
    		Utility::capture($exc);
 	  	}
 	  }
 
    public static function getTotalRows(){
    	$total_rows = 0;
    	try {
    		global $pdo;
    		$sql = 'select count(*) from  tokenproveedor';
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
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Tokenproveedor');
		$salida_vector = array();
		while ($obj = $stmt->fetch()) {
			$salida_vector[] = $obj;
		}
		return $salida_vector;
    }
}
?>