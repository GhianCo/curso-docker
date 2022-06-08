<?php 
class TokenEntity extends EntityBase implements DBOCrud { 
     function __construct($options = array()) { 
        parent::__construct($options);
    }
    public $token_id; 
    public $cliente_id; 
    public $platform_id; 
    public $token_valor; 
    public $token_fcm; 
    public $token_debeexpirar; 
    public $token_deviceid; 
    public $token_device; 
    public $token_fecha; 
    public $token_fechaexpiracion; 
    public $token_version; 
    public $token_estado; 

    public function getToken_id(){ 
        return $this->token_id;
    }
    public function setToken_id($token_id){ 
        $this->token_id = $token_id;
    }
    public function getCliente_id(){ 
        return $this->cliente_id;
    }
    public function setCliente_id($cliente_id){ 
        $this->cliente_id = $cliente_id;
    }
    public function getPlatform_id(){ 
        return $this->platform_id;
    }
    public function setPlatform_id($platform_id){ 
        $this->platform_id = $platform_id;
    }
    public function getToken_valor(){ 
        return $this->token_valor;
    }
    public function setToken_valor($token_valor){ 
        $this->token_valor = $token_valor;
    }
    public function getToken_fcm(){ 
        return $this->token_fcm;
    }
    public function setToken_fcm($token_fcm){ 
        $this->token_fcm = $token_fcm;
    }
    public function getToken_debeexpirar(){ 
        return $this->token_debeexpirar;
    }
    public function setToken_debeexpirar($token_debeexpirar){ 
        $this->token_debeexpirar = $token_debeexpirar;
    }
    public function getToken_deviceid(){ 
        return $this->token_deviceid;
    }
    public function setToken_deviceid($token_deviceid){ 
        $this->token_deviceid = $token_deviceid;
    }
    public function getToken_device(){ 
        return $this->token_device;
    }
    public function setToken_device($token_device){ 
        $this->token_device = $token_device;
    }
    public function getToken_fecha(){ 
        return $this->token_fecha;
    }
    public function setToken_fecha($token_fecha){ 
        $this->token_fecha = $token_fecha;
    }
    public function getToken_fechaexpiracion(){ 
        return $this->token_fechaexpiracion;
    }
    public function setToken_fechaexpiracion($token_fechaexpiracion){ 
        $this->token_fechaexpiracion = $token_fechaexpiracion;
    }
    public function getToken_version(){ 
        return $this->token_version;
    }
    public function setToken_version($token_version){ 
        $this->token_version = $token_version;
    }
    public function getToken_estado(){ 
        return $this->token_estado;
    }
    public function setToken_estado($token_estado){ 
        $this->token_estado = $token_estado;
    }
 
    public function insert(){
    	try {
    		global $pdo;
    		$query = '';
    		$query2 = '';
    		if(isset($this->token_id))
    			$query.='token_id, ';
    		if(isset($this->cliente_id))
    			$query.='cliente_id, ';
    		if(isset($this->platform_id))
    			$query.='platform_id, ';
    		if(isset($this->token_valor))
    			$query.='token_valor, ';
    		if(isset($this->token_fcm))
    			$query.='token_fcm, ';
    		if(isset($this->token_debeexpirar))
    			$query.='token_debeexpirar, ';
    		if(isset($this->token_deviceid))
    			$query.='token_deviceid, ';
    		if(isset($this->token_device))
    			$query.='token_device, ';
    		if(isset($this->token_fecha))
    			$query.='token_fecha, ';
    		if(isset($this->token_fechaexpiracion))
    			$query.='token_fechaexpiracion, ';
    		if(isset($this->token_version))
    			$query.='token_version, ';
    		if(isset($this->token_estado))
    			$query.='token_estado, ';
    		if(isset($this->token_id))
    			$query2.=':token_id, ';
    		if(isset($this->cliente_id))
    			$query2.=':cliente_id, ';
    		if(isset($this->platform_id))
    			$query2.=':platform_id, ';
    		if(isset($this->token_valor))
    			$query2.=':token_valor, ';
    		if(isset($this->token_fcm))
    			$query2.=':token_fcm, ';
    		if(isset($this->token_debeexpirar))
    			$query2.=':token_debeexpirar, ';
    		if(isset($this->token_deviceid))
    			$query2.=':token_deviceid, ';
    		if(isset($this->token_device))
    			$query2.=':token_device, ';
    		if(isset($this->token_fecha))
    			$query2.=':token_fecha, ';
    		if(isset($this->token_fechaexpiracion))
    			$query2.=':token_fechaexpiracion, ';
    		if(isset($this->token_version))
    			$query2.=':token_version, ';
    		if(isset($this->token_estado))
    			$query2.=':token_estado, ';
    		$query = substr($query, 0, strlen($query) - 2);
    		$query2 = substr($query2, 0, strlen($query2) - 2);

    		$stmt = $pdo->prepare('INSERT INTO token('.$query.') VALUES('.$query2.')');

    		if(isset($this->token_id))
    			$stmt->bindParam(':token_id',	$this->token_id,	PDO::PARAM_STR);
    		if(isset($this->cliente_id))
    			$stmt->bindParam(':cliente_id',	$this->cliente_id,	PDO::PARAM_STR);
    		if(isset($this->platform_id))
    			$stmt->bindParam(':platform_id',	$this->platform_id,	PDO::PARAM_STR);
    		if(isset($this->token_valor))
    			$stmt->bindParam(':token_valor',	$this->token_valor,	PDO::PARAM_STR);
    		if(isset($this->token_fcm))
    			$stmt->bindParam(':token_fcm',	$this->token_fcm,	PDO::PARAM_STR);
    		if(isset($this->token_debeexpirar))
    			$stmt->bindParam(':token_debeexpirar',	$this->token_debeexpirar,	PDO::PARAM_STR);
    		if(isset($this->token_deviceid))
    			$stmt->bindParam(':token_deviceid',	$this->token_deviceid,	PDO::PARAM_STR);
    		if(isset($this->token_device))
    			$stmt->bindParam(':token_device',	$this->token_device,	PDO::PARAM_STR);
    		if(isset($this->token_fecha))
    			$stmt->bindParam(':token_fecha',	$this->token_fecha,	PDO::PARAM_STR);
    		if(isset($this->token_fechaexpiracion))
    			$stmt->bindParam(':token_fechaexpiracion',	$this->token_fechaexpiracion,	PDO::PARAM_STR);
    		if(isset($this->token_version))
    			$stmt->bindParam(':token_version',	$this->token_version,	PDO::PARAM_STR);
    		if(isset($this->token_estado))
    			$stmt->bindParam(':token_estado',	$this->token_estado,	PDO::PARAM_STR);
    		$stmt->execute();
    		if($stmt->rowCount() === 1){
    			$id = $pdo->lastInsertId();
    			$this->token_id = $id;
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
    		$query='UPDATE token SET ';
    		if(isset($this->cliente_id))
    			$query.='cliente_id=:cliente_id, ';
    		if(isset($this->platform_id))
    			$query.='platform_id=:platform_id, ';
    		if(isset($this->token_valor))
    			$query.='token_valor=:token_valor, ';
    		if(isset($this->token_fcm))
    			$query.='token_fcm=:token_fcm, ';
    		if(isset($this->token_debeexpirar))
    			$query.='token_debeexpirar=:token_debeexpirar, ';
    		if(isset($this->token_deviceid))
    			$query.='token_deviceid=:token_deviceid, ';
    		if(isset($this->token_device))
    			$query.='token_device=:token_device, ';
    		if(isset($this->token_fecha))
    			$query.='token_fecha=:token_fecha, ';
    		if(isset($this->token_fechaexpiracion))
    			$query.='token_fechaexpiracion=:token_fechaexpiracion, ';
    		if(isset($this->token_version))
    			$query.='token_version=:token_version, ';
    		if(isset($this->token_estado))
    			$query.='token_estado=:token_estado, ';

    		if($query!='UPDATE token SET ')
    			$query = substr($query, 0, strlen($query) - 2);
    		$query.=' WHERE token_id=:token_id';
    		$stmt = $pdo->prepare($query);

    		$stmt->bindParam(':token_id',	$this->token_id,	PDO::PARAM_STR);

    		if(isset($this->cliente_id))
    			$stmt->bindParam(':cliente_id',	$this->cliente_id,	PDO::PARAM_STR);
    		if(isset($this->platform_id))
    			$stmt->bindParam(':platform_id',	$this->platform_id,	PDO::PARAM_STR);
    		if(isset($this->token_valor))
    			$stmt->bindParam(':token_valor',	$this->token_valor,	PDO::PARAM_STR);
    		if(isset($this->token_fcm))
    			$stmt->bindParam(':token_fcm',	$this->token_fcm,	PDO::PARAM_STR);
    		if(isset($this->token_debeexpirar))
    			$stmt->bindParam(':token_debeexpirar',	$this->token_debeexpirar,	PDO::PARAM_STR);
    		if(isset($this->token_deviceid))
    			$stmt->bindParam(':token_deviceid',	$this->token_deviceid,	PDO::PARAM_STR);
    		if(isset($this->token_device))
    			$stmt->bindParam(':token_device',	$this->token_device,	PDO::PARAM_STR);
    		if(isset($this->token_fecha))
    			$stmt->bindParam(':token_fecha',	$this->token_fecha,	PDO::PARAM_STR);
    		if(isset($this->token_fechaexpiracion))
    			$stmt->bindParam(':token_fechaexpiracion',	$this->token_fechaexpiracion,	PDO::PARAM_STR);
    		if(isset($this->token_version))
    			$stmt->bindParam(':token_version',	$this->token_version,	PDO::PARAM_STR);
    		if(isset($this->token_estado))
    			$stmt->bindParam(':token_estado',	$this->token_estado,	PDO::PARAM_STR);
    		return $stmt->execute();
    	} catch (PDOException $e) {
    		echo 'Error: ' . $e->getMessage();
    		Utility::capture($e);
    	}
    }

 
    public function delete(){
    	try {
    		global $pdo;
    		$sql = 'DELETE FROM token WHERE token_id=:token_id';
    		$stmt = $pdo->prepare($sql);
    		$stmt->bindParam(':token_id',$this->token_id, PDO::PARAM_STR);
    		$stmt->execute();
    		return $stmt->rowCount();
    	} catch (Exception $exc) {
    		echo $exc->getTraceAsString();
    		Utility::capture($exc);
    	}
    }
 
    public static function getById($token_id){
    	global $pdo;
    	$sql = 'SELECT * FROM token WHERE token_id=:token_id';
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':token_id',$token_id, PDO::PARAM_STR);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	if($row){
    		return new Token($row);
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
 	  	$orderClause = ' ORDER by token_id';
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
 	  	$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM token '.$whereClause .' '.$orderClause.' ';
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
 	  	$stmt->setFetchMode(PDO::FETCH_CLASS, 'TokenEntity');
 	  	$result = $pdo->query('SELECT FOUND_ROWS() AS totalCount');
 	  	$result->setFetchMode(PDO::FETCH_ASSOC);
 	  	$row = $result->fetch();
 	  	$tbases = array();
 	  	while($tbases = $stmt->fetch()){
 	  		$tbases_vector[] = $tbases;
 	  	}
 	  	return array('token_array' =>$tbases_vector, 'totalCount'=>$row['totalCount']);
 	  	} catch (Exception $exc) {
 	  		echo $exc->getTraceAsString();
    		Utility::capture($exc);
 	  	}
 	  }
 
    public static function getTotalRows(){
    	$total_rows = 0;
    	try {
    		global $pdo;
    		$sql = 'select count(*) from  token';
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
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Token');
		$salida_vector = array();
		while ($obj = $stmt->fetch()) {
			$salida_vector[] = $obj;
		}
		return $salida_vector;
    }
}
?>