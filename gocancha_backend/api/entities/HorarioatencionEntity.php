<?php 
class HorarioatencionEntity extends EntityBase implements DBOCrud { 
     function __construct($options = array()) { 
        parent::__construct($options);
    }
    public $horarioatencion_id; 
    public $horarioatenciondia_id; 
    public $horarioatencion_inicio; 
    public $horarioatencion_fin; 

    public function getHorarioatencion_id(){ 
        return $this->horarioatencion_id;
    }
    public function setHorarioatencion_id($horarioatencion_id){ 
        $this->horarioatencion_id = $horarioatencion_id;
    }
    public function getHorarioatenciondia_id(){ 
        return $this->horarioatenciondia_id;
    }
    public function setHorarioatenciondia_id($horarioatenciondia_id){ 
        $this->horarioatenciondia_id = $horarioatenciondia_id;
    }
    public function getHorarioatencion_inicio(){ 
        return $this->horarioatencion_inicio;
    }
    public function setHorarioatencion_inicio($horarioatencion_inicio){ 
        $this->horarioatencion_inicio = $horarioatencion_inicio;
    }
    public function getHorarioatencion_fin(){ 
        return $this->horarioatencion_fin;
    }
    public function setHorarioatencion_fin($horarioatencion_fin){ 
        $this->horarioatencion_fin = $horarioatencion_fin;
    }
 
    public function insert(){
    	try {
    		global $pdo;
    		$query = '';
    		$query2 = '';
    		if(isset($this->horarioatencion_id))
    			$query.='horarioatencion_id, ';
    		if(isset($this->horarioatenciondia_id))
    			$query.='horarioatenciondia_id, ';
    		if(isset($this->horarioatencion_inicio))
    			$query.='horarioatencion_inicio, ';
    		if(isset($this->horarioatencion_fin))
    			$query.='horarioatencion_fin, ';
    		if(isset($this->horarioatencion_id))
    			$query2.=':horarioatencion_id, ';
    		if(isset($this->horarioatenciondia_id))
    			$query2.=':horarioatenciondia_id, ';
    		if(isset($this->horarioatencion_inicio))
    			$query2.=':horarioatencion_inicio, ';
    		if(isset($this->horarioatencion_fin))
    			$query2.=':horarioatencion_fin, ';
    		$query = substr($query, 0, strlen($query) - 2);
    		$query2 = substr($query2, 0, strlen($query2) - 2);

    		$stmt = $pdo->prepare('INSERT INTO horarioatencion('.$query.') VALUES('.$query2.')');

    		if(isset($this->horarioatencion_id))
    			$stmt->bindParam(':horarioatencion_id',	$this->horarioatencion_id,	PDO::PARAM_STR);
    		if(isset($this->horarioatenciondia_id))
    			$stmt->bindParam(':horarioatenciondia_id',	$this->horarioatenciondia_id,	PDO::PARAM_STR);
    		if(isset($this->horarioatencion_inicio))
    			$stmt->bindParam(':horarioatencion_inicio',	$this->horarioatencion_inicio,	PDO::PARAM_STR);
    		if(isset($this->horarioatencion_fin))
    			$stmt->bindParam(':horarioatencion_fin',	$this->horarioatencion_fin,	PDO::PARAM_STR);
    		$stmt->execute();
    		if($stmt->rowCount() === 1){
    			$id = $pdo->lastInsertId();
    			$this->horarioatencion_id = $id;
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
    		$query='UPDATE horarioatencion SET ';
    		if(isset($this->horarioatenciondia_id))
    			$query.='horarioatenciondia_id=:horarioatenciondia_id, ';
    		if(isset($this->horarioatencion_inicio))
    			$query.='horarioatencion_inicio=:horarioatencion_inicio, ';
    		if(isset($this->horarioatencion_fin))
    			$query.='horarioatencion_fin=:horarioatencion_fin, ';

    		if($query!='UPDATE horarioatencion SET ')
    			$query = substr($query, 0, strlen($query) - 2);
    		$query.=' WHERE horarioatencion_id=:horarioatencion_id';
    		$stmt = $pdo->prepare($query);

    		$stmt->bindParam(':horarioatencion_id',	$this->horarioatencion_id,	PDO::PARAM_STR);

    		if(isset($this->horarioatenciondia_id))
    			$stmt->bindParam(':horarioatenciondia_id',	$this->horarioatenciondia_id,	PDO::PARAM_STR);
    		if(isset($this->horarioatencion_inicio))
    			$stmt->bindParam(':horarioatencion_inicio',	$this->horarioatencion_inicio,	PDO::PARAM_STR);
    		if(isset($this->horarioatencion_fin))
    			$stmt->bindParam(':horarioatencion_fin',	$this->horarioatencion_fin,	PDO::PARAM_STR);
    		return $stmt->execute();
    	} catch (PDOException $e) {
    		echo 'Error: ' . $e->getMessage();
    		Utility::capture($e);
    	}
    }

 
    public function delete(){
    	try {
    		global $pdo;
    		$sql = 'DELETE FROM horarioatencion WHERE horarioatencion_id=:horarioatencion_id';
    		$stmt = $pdo->prepare($sql);
    		$stmt->bindParam(':horarioatencion_id',$this->horarioatencion_id, PDO::PARAM_STR);
    		$stmt->execute();
    		return $stmt->rowCount();
    	} catch (Exception $exc) {
    		echo $exc->getTraceAsString();
    		Utility::capture($exc);
    	}
    }
 
    public static function getById($horarioatencion_id){
    	global $pdo;
    	$sql = 'SELECT * FROM horarioatencion WHERE horarioatencion_id=:horarioatencion_id';
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':horarioatencion_id',$horarioatencion_id, PDO::PARAM_STR);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	if($row){
    		return new Horarioatencion($row);
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
 	  	$orderClause = ' ORDER by horarioatencion_id';
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
 	  	$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM horarioatencion '.$whereClause .' '.$orderClause.' ';
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
 	  	$stmt->setFetchMode(PDO::FETCH_CLASS, 'HorarioatencionEntity');
 	  	$result = $pdo->query('SELECT FOUND_ROWS() AS totalCount');
 	  	$result->setFetchMode(PDO::FETCH_ASSOC);
 	  	$row = $result->fetch();
 	  	$tbases = array();
 	  	while($tbases = $stmt->fetch()){
 	  		$tbases_vector[] = $tbases;
 	  	}
 	  	return array('horarioatencion_array' =>$tbases_vector, 'totalCount'=>$row['totalCount']);
 	  	} catch (Exception $exc) {
 	  		echo $exc->getTraceAsString();
    		Utility::capture($exc);
 	  	}
 	  }
 
    public static function getTotalRows(){
    	$total_rows = 0;
    	try {
    		global $pdo;
    		$sql = 'select count(*) from  horarioatencion';
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
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Horarioatencion');
		$salida_vector = array();
		while ($obj = $stmt->fetch()) {
			$salida_vector[] = $obj;
		}
		return $salida_vector;
    }
}
?>