<?php 
class LoginproveedorEntity extends EntityBase implements DBOCrud { 
     function __construct($options = array()) { 
        parent::__construct($options);
    }
    public $loginproveedor_id; 
    public $login_id; 
    public $proveedor_id; 

    public function getLoginproveedor_id(){ 
        return $this->loginproveedor_id;
    }
    public function setLoginproveedor_id($loginproveedor_id){ 
        $this->loginproveedor_id = $loginproveedor_id;
    }
    public function getLogin_id(){ 
        return $this->login_id;
    }
    public function setLogin_id($login_id){ 
        $this->login_id = $login_id;
    }
    public function getProveedor_id(){ 
        return $this->proveedor_id;
    }
    public function setProveedor_id($proveedor_id){ 
        $this->proveedor_id = $proveedor_id;
    }
 
    public function insert(){
    	try {
    		global $pdo;
    		$query = '';
    		$query2 = '';
    		if(isset($this->loginproveedor_id))
    			$query.='loginproveedor_id, ';
    		if(isset($this->login_id))
    			$query.='login_id, ';
    		if(isset($this->proveedor_id))
    			$query.='proveedor_id, ';
    		if(isset($this->loginproveedor_id))
    			$query2.=':loginproveedor_id, ';
    		if(isset($this->login_id))
    			$query2.=':login_id, ';
    		if(isset($this->proveedor_id))
    			$query2.=':proveedor_id, ';
    		$query = substr($query, 0, strlen($query) - 2);
    		$query2 = substr($query2, 0, strlen($query2) - 2);

    		$stmt = $pdo->prepare('INSERT INTO loginproveedor('.$query.') VALUES('.$query2.')');

    		if(isset($this->loginproveedor_id))
    			$stmt->bindParam(':loginproveedor_id',	$this->loginproveedor_id,	PDO::PARAM_STR);
    		if(isset($this->login_id))
    			$stmt->bindParam(':login_id',	$this->login_id,	PDO::PARAM_STR);
    		if(isset($this->proveedor_id))
    			$stmt->bindParam(':proveedor_id',	$this->proveedor_id,	PDO::PARAM_STR);
    		$stmt->execute();
    		if($stmt->rowCount() === 1){
    			$id = $pdo->lastInsertId();
    			$this->loginproveedor_id = $id;
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
    		$query='UPDATE loginproveedor SET ';
    		if(isset($this->login_id))
    			$query.='login_id=:login_id, ';
    		if(isset($this->proveedor_id))
    			$query.='proveedor_id=:proveedor_id, ';

    		if($query!='UPDATE loginproveedor SET ')
    			$query = substr($query, 0, strlen($query) - 2);
    		$query.=' WHERE loginproveedor_id=:loginproveedor_id';
    		$stmt = $pdo->prepare($query);

    		$stmt->bindParam(':loginproveedor_id',	$this->loginproveedor_id,	PDO::PARAM_STR);

    		if(isset($this->login_id))
    			$stmt->bindParam(':login_id',	$this->login_id,	PDO::PARAM_STR);
    		if(isset($this->proveedor_id))
    			$stmt->bindParam(':proveedor_id',	$this->proveedor_id,	PDO::PARAM_STR);
    		return $stmt->execute();
    	} catch (PDOException $e) {
    		echo 'Error: ' . $e->getMessage();
    		Utility::capture($e);
    	}
    }

 
    public function delete(){
    	try {
    		global $pdo;
    		$sql = 'DELETE FROM loginproveedor WHERE loginproveedor_id=:loginproveedor_id';
    		$stmt = $pdo->prepare($sql);
    		$stmt->bindParam(':loginproveedor_id',$this->loginproveedor_id, PDO::PARAM_STR);
    		$stmt->execute();
    		return $stmt->rowCount();
    	} catch (Exception $exc) {
    		echo $exc->getTraceAsString();
    		Utility::capture($exc);
    	}
    }
 
    public static function getById($loginproveedor_id){
    	global $pdo;
    	$sql = 'SELECT * FROM loginproveedor WHERE loginproveedor_id=:loginproveedor_id';
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':loginproveedor_id',$loginproveedor_id, PDO::PARAM_STR);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	if($row){
    		return new Loginproveedor($row);
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
 	  	$orderClause = ' ORDER by loginproveedor_id';
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
 	  	$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM loginproveedor '.$whereClause .' '.$orderClause.' ';
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
 	  	$stmt->setFetchMode(PDO::FETCH_CLASS, 'LoginproveedorEntity');
 	  	$result = $pdo->query('SELECT FOUND_ROWS() AS totalCount');
 	  	$result->setFetchMode(PDO::FETCH_ASSOC);
 	  	$row = $result->fetch();
 	  	$tbases = array();
 	  	while($tbases = $stmt->fetch()){
 	  		$tbases_vector[] = $tbases;
 	  	}
 	  	return array('loginproveedor_array' =>$tbases_vector, 'totalCount'=>$row['totalCount']);
 	  	} catch (Exception $exc) {
 	  		echo $exc->getTraceAsString();
    		Utility::capture($exc);
 	  	}
 	  }
 
    public static function getTotalRows(){
    	$total_rows = 0;
    	try {
    		global $pdo;
    		$sql = 'select count(*) from  loginproveedor';
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
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Loginproveedor');
		$salida_vector = array();
		while ($obj = $stmt->fetch()) {
			$salida_vector[] = $obj;
		}
		return $salida_vector;
    }
}
?>