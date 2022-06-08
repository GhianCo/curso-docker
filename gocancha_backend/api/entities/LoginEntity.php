<?php 
class LoginEntity extends EntityBase implements DBOCrud { 
     function __construct($options = array()) { 
        parent::__construct($options);
    }
    public $login_id; 
    public $login_nombres; 
    public $login_apellidos; 
    public $login_usuario; 
    public $login_clave; 
    public $login_estado; 

    public function getLogin_id(){ 
        return $this->login_id;
    }
    public function setLogin_id($login_id){ 
        $this->login_id = $login_id;
    }
    public function getLogin_nombres(){ 
        return $this->login_nombres;
    }
    public function setLogin_nombres($login_nombres){ 
        $this->login_nombres = $login_nombres;
    }
    public function getLogin_apellidos(){ 
        return $this->login_apellidos;
    }
    public function setLogin_apellidos($login_apellidos){ 
        $this->login_apellidos = $login_apellidos;
    }
    public function getLogin_usuario(){ 
        return $this->login_usuario;
    }
    public function setLogin_usuario($login_usuario){ 
        $this->login_usuario = $login_usuario;
    }
    public function getLogin_clave(){ 
        return $this->login_clave;
    }
    public function setLogin_clave($login_clave){ 
        $this->login_clave = $login_clave;
    }
    public function getLogin_estado(){ 
        return $this->login_estado;
    }
    public function setLogin_estado($login_estado){ 
        $this->login_estado = $login_estado;
    }
 
    public function insert(){
    	try {
    		global $pdo;
    		$query = '';
    		$query2 = '';
    		if(isset($this->login_id))
    			$query.='login_id, ';
    		if(isset($this->login_nombres))
    			$query.='login_nombres, ';
    		if(isset($this->login_apellidos))
    			$query.='login_apellidos, ';
    		if(isset($this->login_usuario))
    			$query.='login_usuario, ';
    		if(isset($this->login_clave))
    			$query.='login_clave, ';
    		if(isset($this->login_estado))
    			$query.='login_estado, ';
    		if(isset($this->login_id))
    			$query2.=':login_id, ';
    		if(isset($this->login_nombres))
    			$query2.=':login_nombres, ';
    		if(isset($this->login_apellidos))
    			$query2.=':login_apellidos, ';
    		if(isset($this->login_usuario))
    			$query2.=':login_usuario, ';
    		if(isset($this->login_clave))
    			$query2.=':login_clave, ';
    		if(isset($this->login_estado))
    			$query2.=':login_estado, ';
    		$query = substr($query, 0, strlen($query) - 2);
    		$query2 = substr($query2, 0, strlen($query2) - 2);

    		$stmt = $pdo->prepare('INSERT INTO login('.$query.') VALUES('.$query2.')');

    		if(isset($this->login_id))
    			$stmt->bindParam(':login_id',	$this->login_id,	PDO::PARAM_STR);
    		if(isset($this->login_nombres))
    			$stmt->bindParam(':login_nombres',	$this->login_nombres,	PDO::PARAM_STR);
    		if(isset($this->login_apellidos))
    			$stmt->bindParam(':login_apellidos',	$this->login_apellidos,	PDO::PARAM_STR);
    		if(isset($this->login_usuario))
    			$stmt->bindParam(':login_usuario',	$this->login_usuario,	PDO::PARAM_STR);
    		if(isset($this->login_clave))
    			$stmt->bindParam(':login_clave',	$this->login_clave,	PDO::PARAM_STR);
    		if(isset($this->login_estado))
    			$stmt->bindParam(':login_estado',	$this->login_estado,	PDO::PARAM_STR);
    		$stmt->execute();
    		if($stmt->rowCount() === 1){
    			$id = $pdo->lastInsertId();
    			$this->login_id = $id;
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
    		$query='UPDATE login SET ';
    		if(isset($this->login_nombres))
    			$query.='login_nombres=:login_nombres, ';
    		if(isset($this->login_apellidos))
    			$query.='login_apellidos=:login_apellidos, ';
    		if(isset($this->login_usuario))
    			$query.='login_usuario=:login_usuario, ';
    		if(isset($this->login_clave))
    			$query.='login_clave=:login_clave, ';
    		if(isset($this->login_estado))
    			$query.='login_estado=:login_estado, ';

    		if($query!='UPDATE login SET ')
    			$query = substr($query, 0, strlen($query) - 2);
    		$query.=' WHERE login_id=:login_id';
    		$stmt = $pdo->prepare($query);

    		$stmt->bindParam(':login_id',	$this->login_id,	PDO::PARAM_STR);

    		if(isset($this->login_nombres))
    			$stmt->bindParam(':login_nombres',	$this->login_nombres,	PDO::PARAM_STR);
    		if(isset($this->login_apellidos))
    			$stmt->bindParam(':login_apellidos',	$this->login_apellidos,	PDO::PARAM_STR);
    		if(isset($this->login_usuario))
    			$stmt->bindParam(':login_usuario',	$this->login_usuario,	PDO::PARAM_STR);
    		if(isset($this->login_clave))
    			$stmt->bindParam(':login_clave',	$this->login_clave,	PDO::PARAM_STR);
    		if(isset($this->login_estado))
    			$stmt->bindParam(':login_estado',	$this->login_estado,	PDO::PARAM_STR);
    		return $stmt->execute();
    	} catch (PDOException $e) {
    		echo 'Error: ' . $e->getMessage();
    		Utility::capture($e);
    	}
    }

 
    public function delete(){
    	try {
    		global $pdo;
    		$sql = 'DELETE FROM login WHERE login_id=:login_id';
    		$stmt = $pdo->prepare($sql);
    		$stmt->bindParam(':login_id',$this->login_id, PDO::PARAM_STR);
    		$stmt->execute();
    		return $stmt->rowCount();
    	} catch (Exception $exc) {
    		echo $exc->getTraceAsString();
    		Utility::capture($exc);
    	}
    }
 
    public static function getById($login_id){
    	global $pdo;
    	$sql = 'SELECT * FROM login WHERE login_id=:login_id';
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':login_id',$login_id, PDO::PARAM_STR);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	if($row){
    		return new Login($row);
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
 	  	$orderClause = ' ORDER by login_id';
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
 	  	$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM login '.$whereClause .' '.$orderClause.' ';
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
 	  	$stmt->setFetchMode(PDO::FETCH_CLASS, 'LoginEntity');
 	  	$result = $pdo->query('SELECT FOUND_ROWS() AS totalCount');
 	  	$result->setFetchMode(PDO::FETCH_ASSOC);
 	  	$row = $result->fetch();
 	  	$tbases = array();
 	  	while($tbases = $stmt->fetch()){
 	  		$tbases_vector[] = $tbases;
 	  	}
 	  	return array('login_array' =>$tbases_vector, 'totalCount'=>$row['totalCount']);
 	  	} catch (Exception $exc) {
 	  		echo $exc->getTraceAsString();
    		Utility::capture($exc);
 	  	}
 	  }
 
    public static function getTotalRows(){
    	$total_rows = 0;
    	try {
    		global $pdo;
    		$sql = 'select count(*) from  login';
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
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Login');
		$salida_vector = array();
		while ($obj = $stmt->fetch()) {
			$salida_vector[] = $obj;
		}
		return $salida_vector;
    }
}
?>