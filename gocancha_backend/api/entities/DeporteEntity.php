<?php 
class DeporteEntity extends EntityBase implements DBOCrud { 
     function __construct($options = array()) { 
        parent::__construct($options);
    }
    public $deporte_id; 
    public $deporte_nombre; 
    public $deporte_urlimagen; 
    public $deporte_orden; 
    public $deporte_estado; 

    public function getDeporte_id(){ 
        return $this->deporte_id;
    }
    public function setDeporte_id($deporte_id){ 
        $this->deporte_id = $deporte_id;
    }
    public function getDeporte_nombre(){ 
        return $this->deporte_nombre;
    }
    public function setDeporte_nombre($deporte_nombre){ 
        $this->deporte_nombre = $deporte_nombre;
    }
    public function getDeporte_urlimagen(){ 
        return $this->deporte_urlimagen;
    }
    public function setDeporte_urlimagen($deporte_urlimagen){ 
        $this->deporte_urlimagen = $deporte_urlimagen;
    }
    public function getDeporte_orden(){ 
        return $this->deporte_orden;
    }
    public function setDeporte_orden($deporte_orden){ 
        $this->deporte_orden = $deporte_orden;
    }
    public function getDeporte_estado(){ 
        return $this->deporte_estado;
    }
    public function setDeporte_estado($deporte_estado){ 
        $this->deporte_estado = $deporte_estado;
    }
 
    public function insert(){
    	try {
    		global $pdo;
    		$query = '';
    		$query2 = '';
    		if(isset($this->deporte_id))
    			$query.='deporte_id, ';
    		if(isset($this->deporte_nombre))
    			$query.='deporte_nombre, ';
    		if(isset($this->deporte_urlimagen))
    			$query.='deporte_urlimagen, ';
    		if(isset($this->deporte_orden))
    			$query.='deporte_orden, ';
    		if(isset($this->deporte_estado))
    			$query.='deporte_estado, ';
    		if(isset($this->deporte_id))
    			$query2.=':deporte_id, ';
    		if(isset($this->deporte_nombre))
    			$query2.=':deporte_nombre, ';
    		if(isset($this->deporte_urlimagen))
    			$query2.=':deporte_urlimagen, ';
    		if(isset($this->deporte_orden))
    			$query2.=':deporte_orden, ';
    		if(isset($this->deporte_estado))
    			$query2.=':deporte_estado, ';
    		$query = substr($query, 0, strlen($query) - 2);
    		$query2 = substr($query2, 0, strlen($query2) - 2);

    		$stmt = $pdo->prepare('INSERT INTO deporte('.$query.') VALUES('.$query2.')');

    		if(isset($this->deporte_id))
    			$stmt->bindParam(':deporte_id',	$this->deporte_id,	PDO::PARAM_STR);
    		if(isset($this->deporte_nombre))
    			$stmt->bindParam(':deporte_nombre',	$this->deporte_nombre,	PDO::PARAM_STR);
    		if(isset($this->deporte_urlimagen))
    			$stmt->bindParam(':deporte_urlimagen',	$this->deporte_urlimagen,	PDO::PARAM_STR);
    		if(isset($this->deporte_orden))
    			$stmt->bindParam(':deporte_orden',	$this->deporte_orden,	PDO::PARAM_STR);
    		if(isset($this->deporte_estado))
    			$stmt->bindParam(':deporte_estado',	$this->deporte_estado,	PDO::PARAM_STR);
    		$stmt->execute();
    		if($stmt->rowCount() === 1){
    			$id = $pdo->lastInsertId();
    			$this->deporte_id = $id;
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
    		$query='UPDATE deporte SET ';
    		if(isset($this->deporte_nombre))
    			$query.='deporte_nombre=:deporte_nombre, ';
    		if(isset($this->deporte_urlimagen))
    			$query.='deporte_urlimagen=:deporte_urlimagen, ';
    		if(isset($this->deporte_orden))
    			$query.='deporte_orden=:deporte_orden, ';
    		if(isset($this->deporte_estado))
    			$query.='deporte_estado=:deporte_estado, ';

    		if($query!='UPDATE deporte SET ')
    			$query = substr($query, 0, strlen($query) - 2);
    		$query.=' WHERE deporte_id=:deporte_id';
    		$stmt = $pdo->prepare($query);

    		$stmt->bindParam(':deporte_id',	$this->deporte_id,	PDO::PARAM_STR);

    		if(isset($this->deporte_nombre))
    			$stmt->bindParam(':deporte_nombre',	$this->deporte_nombre,	PDO::PARAM_STR);
    		if(isset($this->deporte_urlimagen))
    			$stmt->bindParam(':deporte_urlimagen',	$this->deporte_urlimagen,	PDO::PARAM_STR);
    		if(isset($this->deporte_orden))
    			$stmt->bindParam(':deporte_orden',	$this->deporte_orden,	PDO::PARAM_STR);
    		if(isset($this->deporte_estado))
    			$stmt->bindParam(':deporte_estado',	$this->deporte_estado,	PDO::PARAM_STR);
    		return $stmt->execute();
    	} catch (PDOException $e) {
    		echo 'Error: ' . $e->getMessage();
    		Utility::capture($e);
    	}
    }

 
    public function delete(){
    	try {
    		global $pdo;
    		$sql = 'DELETE FROM deporte WHERE deporte_id=:deporte_id';
    		$stmt = $pdo->prepare($sql);
    		$stmt->bindParam(':deporte_id',$this->deporte_id, PDO::PARAM_STR);
    		$stmt->execute();
    		return $stmt->rowCount();
    	} catch (Exception $exc) {
    		echo $exc->getTraceAsString();
    		Utility::capture($exc);
    	}
    }
 
    public static function getById($deporte_id){
    	global $pdo;
    	$sql = 'SELECT * FROM deporte WHERE deporte_id=:deporte_id';
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':deporte_id',$deporte_id, PDO::PARAM_STR);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	if($row){
    		return new Deporte($row);
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
 	  	$orderClause = ' ORDER by deporte_id';
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
 	  	$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM deporte '.$whereClause .' '.$orderClause.' ';
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
 	  	$stmt->setFetchMode(PDO::FETCH_CLASS, 'DeporteEntity');
 	  	$result = $pdo->query('SELECT FOUND_ROWS() AS totalCount');
 	  	$result->setFetchMode(PDO::FETCH_ASSOC);
 	  	$row = $result->fetch();
 	  	$tbases = array();
 	  	while($tbases = $stmt->fetch()){
 	  		$tbases_vector[] = $tbases;
 	  	}
 	  	return array('deporte_array' =>$tbases_vector, 'totalCount'=>$row['totalCount']);
 	  	} catch (Exception $exc) {
 	  		echo $exc->getTraceAsString();
    		Utility::capture($exc);
 	  	}
 	  }
 
    public static function getTotalRows(){
    	$total_rows = 0;
    	try {
    		global $pdo;
    		$sql = 'select count(*) from  deporte';
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
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Deporte');
		$salida_vector = array();
		while ($obj = $stmt->fetch()) {
			$salida_vector[] = $obj;
		}
		return $salida_vector;
    }
}
?>