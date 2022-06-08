<?php 
class AddressEntity extends EntityBase implements DBOCrud { 
     function __construct($options = array()) { 
        parent::__construct($options);
    }
    public $address_id; 
    public $cliente_id; 
    public $address_distrito; 
    public $address_calle; 
    public $address_numero; 
    public $address_referencia; 
    public $address_latitud; 
    public $address_longitud; 
    public $address_direccionusuario; 
    public $address_estado; 
    public $address_default; 

    public function getAddress_id(){ 
        return $this->address_id;
    }
    public function setAddress_id($address_id){ 
        $this->address_id = $address_id;
    }
    public function getCliente_id(){ 
        return $this->cliente_id;
    }
    public function setCliente_id($cliente_id){ 
        $this->cliente_id = $cliente_id;
    }
    public function getAddress_distrito(){ 
        return $this->address_distrito;
    }
    public function setAddress_distrito($address_distrito){ 
        $this->address_distrito = $address_distrito;
    }
    public function getAddress_calle(){ 
        return $this->address_calle;
    }
    public function setAddress_calle($address_calle){ 
        $this->address_calle = $address_calle;
    }
    public function getAddress_numero(){ 
        return $this->address_numero;
    }
    public function setAddress_numero($address_numero){ 
        $this->address_numero = $address_numero;
    }
    public function getAddress_referencia(){ 
        return $this->address_referencia;
    }
    public function setAddress_referencia($address_referencia){ 
        $this->address_referencia = $address_referencia;
    }
    public function getAddress_latitud(){ 
        return $this->address_latitud;
    }
    public function setAddress_latitud($address_latitud){ 
        $this->address_latitud = $address_latitud;
    }
    public function getAddress_longitud(){ 
        return $this->address_longitud;
    }
    public function setAddress_longitud($address_longitud){ 
        $this->address_longitud = $address_longitud;
    }
    public function getAddress_direccionusuario(){ 
        return $this->address_direccionusuario;
    }
    public function setAddress_direccionusuario($address_direccionusuario){ 
        $this->address_direccionusuario = $address_direccionusuario;
    }
    public function getAddress_estado(){ 
        return $this->address_estado;
    }
    public function setAddress_estado($address_estado){ 
        $this->address_estado = $address_estado;
    }
    public function getAddress_default(){ 
        return $this->address_default;
    }
    public function setAddress_default($address_default){ 
        $this->address_default = $address_default;
    }
 
    public function insert(){
    	try {
    		global $pdo;
    		$query = '';
    		$query2 = '';
    		if(isset($this->address_id))
    			$query.='address_id, ';
    		if(isset($this->cliente_id))
    			$query.='cliente_id, ';
    		if(isset($this->address_distrito))
    			$query.='address_distrito, ';
    		if(isset($this->address_calle))
    			$query.='address_calle, ';
    		if(isset($this->address_numero))
    			$query.='address_numero, ';
    		if(isset($this->address_referencia))
    			$query.='address_referencia, ';
    		if(isset($this->address_latitud))
    			$query.='address_latitud, ';
    		if(isset($this->address_longitud))
    			$query.='address_longitud, ';
    		if(isset($this->address_direccionusuario))
    			$query.='address_direccionusuario, ';
    		if(isset($this->address_estado))
    			$query.='address_estado, ';
    		if(isset($this->address_default))
    			$query.='address_default, ';
    		if(isset($this->address_id))
    			$query2.=':address_id, ';
    		if(isset($this->cliente_id))
    			$query2.=':cliente_id, ';
    		if(isset($this->address_distrito))
    			$query2.=':address_distrito, ';
    		if(isset($this->address_calle))
    			$query2.=':address_calle, ';
    		if(isset($this->address_numero))
    			$query2.=':address_numero, ';
    		if(isset($this->address_referencia))
    			$query2.=':address_referencia, ';
    		if(isset($this->address_latitud))
    			$query2.=':address_latitud, ';
    		if(isset($this->address_longitud))
    			$query2.=':address_longitud, ';
    		if(isset($this->address_direccionusuario))
    			$query2.=':address_direccionusuario, ';
    		if(isset($this->address_estado))
    			$query2.=':address_estado, ';
    		if(isset($this->address_default))
    			$query2.=':address_default, ';
    		$query = substr($query, 0, strlen($query) - 2);
    		$query2 = substr($query2, 0, strlen($query2) - 2);

    		$stmt = $pdo->prepare('INSERT INTO address('.$query.') VALUES('.$query2.')');

    		if(isset($this->address_id))
    			$stmt->bindParam(':address_id',	$this->address_id,	PDO::PARAM_STR);
    		if(isset($this->cliente_id))
    			$stmt->bindParam(':cliente_id',	$this->cliente_id,	PDO::PARAM_STR);
    		if(isset($this->address_distrito))
    			$stmt->bindParam(':address_distrito',	$this->address_distrito,	PDO::PARAM_STR);
    		if(isset($this->address_calle))
    			$stmt->bindParam(':address_calle',	$this->address_calle,	PDO::PARAM_STR);
    		if(isset($this->address_numero))
    			$stmt->bindParam(':address_numero',	$this->address_numero,	PDO::PARAM_STR);
    		if(isset($this->address_referencia))
    			$stmt->bindParam(':address_referencia',	$this->address_referencia,	PDO::PARAM_STR);
    		if(isset($this->address_latitud))
    			$stmt->bindParam(':address_latitud',	$this->address_latitud,	PDO::PARAM_STR);
    		if(isset($this->address_longitud))
    			$stmt->bindParam(':address_longitud',	$this->address_longitud,	PDO::PARAM_STR);
    		if(isset($this->address_direccionusuario))
    			$stmt->bindParam(':address_direccionusuario',	$this->address_direccionusuario,	PDO::PARAM_STR);
    		if(isset($this->address_estado))
    			$stmt->bindParam(':address_estado',	$this->address_estado,	PDO::PARAM_STR);
    		if(isset($this->address_default))
    			$stmt->bindParam(':address_default',	$this->address_default,	PDO::PARAM_STR);
    		$stmt->execute();
    		if($stmt->rowCount() === 1){
    			$id = $pdo->lastInsertId();
    			$this->address_id = $id;
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
    		$query='UPDATE address SET ';
    		if(isset($this->cliente_id))
    			$query.='cliente_id=:cliente_id, ';
    		if(isset($this->address_distrito))
    			$query.='address_distrito=:address_distrito, ';
    		if(isset($this->address_calle))
    			$query.='address_calle=:address_calle, ';
    		if(isset($this->address_numero))
    			$query.='address_numero=:address_numero, ';
    		if(isset($this->address_referencia))
    			$query.='address_referencia=:address_referencia, ';
    		if(isset($this->address_latitud))
    			$query.='address_latitud=:address_latitud, ';
    		if(isset($this->address_longitud))
    			$query.='address_longitud=:address_longitud, ';
    		if(isset($this->address_direccionusuario))
    			$query.='address_direccionusuario=:address_direccionusuario, ';
    		if(isset($this->address_estado))
    			$query.='address_estado=:address_estado, ';
    		if(isset($this->address_default))
    			$query.='address_default=:address_default, ';

    		if($query!='UPDATE address SET ')
    			$query = substr($query, 0, strlen($query) - 2);
    		$query.=' WHERE address_id=:address_id';
    		$stmt = $pdo->prepare($query);

    		$stmt->bindParam(':address_id',	$this->address_id,	PDO::PARAM_STR);

    		if(isset($this->cliente_id))
    			$stmt->bindParam(':cliente_id',	$this->cliente_id,	PDO::PARAM_STR);
    		if(isset($this->address_distrito))
    			$stmt->bindParam(':address_distrito',	$this->address_distrito,	PDO::PARAM_STR);
    		if(isset($this->address_calle))
    			$stmt->bindParam(':address_calle',	$this->address_calle,	PDO::PARAM_STR);
    		if(isset($this->address_numero))
    			$stmt->bindParam(':address_numero',	$this->address_numero,	PDO::PARAM_STR);
    		if(isset($this->address_referencia))
    			$stmt->bindParam(':address_referencia',	$this->address_referencia,	PDO::PARAM_STR);
    		if(isset($this->address_latitud))
    			$stmt->bindParam(':address_latitud',	$this->address_latitud,	PDO::PARAM_STR);
    		if(isset($this->address_longitud))
    			$stmt->bindParam(':address_longitud',	$this->address_longitud,	PDO::PARAM_STR);
    		if(isset($this->address_direccionusuario))
    			$stmt->bindParam(':address_direccionusuario',	$this->address_direccionusuario,	PDO::PARAM_STR);
    		if(isset($this->address_estado))
    			$stmt->bindParam(':address_estado',	$this->address_estado,	PDO::PARAM_STR);
    		if(isset($this->address_default))
    			$stmt->bindParam(':address_default',	$this->address_default,	PDO::PARAM_STR);
    		return $stmt->execute();
    	} catch (PDOException $e) {
    		echo 'Error: ' . $e->getMessage();
    		Utility::capture($e);
    	}
    }

 
    public function delete(){
    	try {
    		global $pdo;
    		$sql = 'DELETE FROM address WHERE address_id=:address_id';
    		$stmt = $pdo->prepare($sql);
    		$stmt->bindParam(':address_id',$this->address_id, PDO::PARAM_STR);
    		$stmt->execute();
    		return $stmt->rowCount();
    	} catch (Exception $exc) {
    		echo $exc->getTraceAsString();
    		Utility::capture($exc);
    	}
    }
 
    public static function getById($address_id){
    	global $pdo;
    	$sql = 'SELECT * FROM address WHERE address_id=:address_id';
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':address_id',$address_id, PDO::PARAM_STR);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	if($row){
    		return new Address($row);
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
 	  	$orderClause = ' ORDER by address_id';
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
 	  	$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM address '.$whereClause .' '.$orderClause.' ';
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
 	  	$stmt->setFetchMode(PDO::FETCH_CLASS, 'AddressEntity');
 	  	$result = $pdo->query('SELECT FOUND_ROWS() AS totalCount');
 	  	$result->setFetchMode(PDO::FETCH_ASSOC);
 	  	$row = $result->fetch();
 	  	$tbases = array();
 	  	while($tbases = $stmt->fetch()){
 	  		$tbases_vector[] = $tbases;
 	  	}
 	  	return array('address_array' =>$tbases_vector, 'totalCount'=>$row['totalCount']);
 	  	} catch (Exception $exc) {
 	  		echo $exc->getTraceAsString();
    		Utility::capture($exc);
 	  	}
 	  }
 
    public static function getTotalRows(){
    	$total_rows = 0;
    	try {
    		global $pdo;
    		$sql = 'select count(*) from  address';
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
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Address');
		$salida_vector = array();
		while ($obj = $stmt->fetch()) {
			$salida_vector[] = $obj;
		}
		return $salida_vector;
    }
}
?>