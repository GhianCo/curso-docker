<?php 
class CaracteristicaEntity extends EntityBase implements DBOCrud { 
     function __construct($options = array()) { 
        parent::__construct($options);
    }
    public $caracteristica_id; 
    public $caracteristica_nombre; 
    public $caracteristica_estado; 

    public function getCaracteristica_id(){ 
        return $this->caracteristica_id;
    }
    public function setCaracteristica_id($caracteristica_id){ 
        $this->caracteristica_id = $caracteristica_id;
    }
    public function getCaracteristica_nombre(){ 
        return $this->caracteristica_nombre;
    }
    public function setCaracteristica_nombre($caracteristica_nombre){ 
        $this->caracteristica_nombre = $caracteristica_nombre;
    }
    public function getCaracteristica_estado(){ 
        return $this->caracteristica_estado;
    }
    public function setCaracteristica_estado($caracteristica_estado){ 
        $this->caracteristica_estado = $caracteristica_estado;
    }
 
    public function insert(){
    	try {
    		global $pdo;
    		$query = '';
    		$query2 = '';
    		if(isset($this->caracteristica_id))
    			$query.='caracteristica_id, ';
    		if(isset($this->caracteristica_nombre))
    			$query.='caracteristica_nombre, ';
    		if(isset($this->caracteristica_estado))
    			$query.='caracteristica_estado, ';
    		if(isset($this->caracteristica_id))
    			$query2.=':caracteristica_id, ';
    		if(isset($this->caracteristica_nombre))
    			$query2.=':caracteristica_nombre, ';
    		if(isset($this->caracteristica_estado))
    			$query2.=':caracteristica_estado, ';
    		$query = substr($query, 0, strlen($query) - 2);
    		$query2 = substr($query2, 0, strlen($query2) - 2);

    		$stmt = $pdo->prepare('INSERT INTO caracteristica('.$query.') VALUES('.$query2.')');

    		if(isset($this->caracteristica_id))
    			$stmt->bindParam(':caracteristica_id',	$this->caracteristica_id,	PDO::PARAM_STR);
    		if(isset($this->caracteristica_nombre))
    			$stmt->bindParam(':caracteristica_nombre',	$this->caracteristica_nombre,	PDO::PARAM_STR);
    		if(isset($this->caracteristica_estado))
    			$stmt->bindParam(':caracteristica_estado',	$this->caracteristica_estado,	PDO::PARAM_STR);
    		$stmt->execute();
    		if($stmt->rowCount() === 1){
    			$id = $pdo->lastInsertId();
    			$this->caracteristica_id = $id;
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
    		$query='UPDATE caracteristica SET ';
    		if(isset($this->caracteristica_nombre))
    			$query.='caracteristica_nombre=:caracteristica_nombre, ';
    		if(isset($this->caracteristica_estado))
    			$query.='caracteristica_estado=:caracteristica_estado, ';

    		if($query!='UPDATE caracteristica SET ')
    			$query = substr($query, 0, strlen($query) - 2);
    		$query.=' WHERE caracteristica_id=:caracteristica_id';
    		$stmt = $pdo->prepare($query);

    		$stmt->bindParam(':caracteristica_id',	$this->caracteristica_id,	PDO::PARAM_STR);

    		if(isset($this->caracteristica_nombre))
    			$stmt->bindParam(':caracteristica_nombre',	$this->caracteristica_nombre,	PDO::PARAM_STR);
    		if(isset($this->caracteristica_estado))
    			$stmt->bindParam(':caracteristica_estado',	$this->caracteristica_estado,	PDO::PARAM_STR);
    		return $stmt->execute();
    	} catch (PDOException $e) {
    		echo 'Error: ' . $e->getMessage();
    		Utility::capture($e);
    	}
    }

 
    public function delete(){
    	try {
    		global $pdo;
    		$sql = 'DELETE FROM caracteristica WHERE caracteristica_id=:caracteristica_id';
    		$stmt = $pdo->prepare($sql);
    		$stmt->bindParam(':caracteristica_id',$this->caracteristica_id, PDO::PARAM_STR);
    		$stmt->execute();
    		return $stmt->rowCount();
    	} catch (Exception $exc) {
    		echo $exc->getTraceAsString();
    		Utility::capture($exc);
    	}
    }
 
    public static function getById($caracteristica_id){
    	global $pdo;
    	$sql = 'SELECT * FROM caracteristica WHERE caracteristica_id=:caracteristica_id';
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':caracteristica_id',$caracteristica_id, PDO::PARAM_STR);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	if($row){
    		return new Caracteristica($row);
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
 	  	$orderClause = ' ORDER by caracteristica_id';
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
 	  	$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM caracteristica '.$whereClause .' '.$orderClause.' ';
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
 	  	$stmt->setFetchMode(PDO::FETCH_CLASS, 'CaracteristicaEntity');
 	  	$result = $pdo->query('SELECT FOUND_ROWS() AS totalCount');
 	  	$result->setFetchMode(PDO::FETCH_ASSOC);
 	  	$row = $result->fetch();
 	  	$tbases = array();
 	  	while($tbases = $stmt->fetch()){
 	  		$tbases_vector[] = $tbases;
 	  	}
 	  	return array('caracteristica_array' =>$tbases_vector, 'totalCount'=>$row['totalCount']);
 	  	} catch (Exception $exc) {
 	  		echo $exc->getTraceAsString();
    		Utility::capture($exc);
 	  	}
 	  }
 
    public static function getTotalRows(){
    	$total_rows = 0;
    	try {
    		global $pdo;
    		$sql = 'select count(*) from  caracteristica';
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
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Caracteristica');
		$salida_vector = array();
		while ($obj = $stmt->fetch()) {
			$salida_vector[] = $obj;
		}
		return $salida_vector;
    }
}
?>