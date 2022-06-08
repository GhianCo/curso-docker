<?php 
class PagodataEntity extends EntityBase implements DBOCrud { 
     function __construct($options = array()) { 
        parent::__construct($options);
    }
    public $pagodata_id; 
    public $reserva_id; 
    public $pagodata_json; 
    public $pagodata_integracion; 

    public function getPagodata_id(){ 
        return $this->pagodata_id;
    }
    public function setPagodata_id($pagodata_id){ 
        $this->pagodata_id = $pagodata_id;
    }
    public function getReserva_id(){ 
        return $this->reserva_id;
    }
    public function setReserva_id($reserva_id){ 
        $this->reserva_id = $reserva_id;
    }
    public function getPagodata_json(){ 
        return $this->pagodata_json;
    }
    public function setPagodata_json($pagodata_json){ 
        $this->pagodata_json = $pagodata_json;
    }
    public function getPagodata_integracion(){ 
        return $this->pagodata_integracion;
    }
    public function setPagodata_integracion($pagodata_integracion){ 
        $this->pagodata_integracion = $pagodata_integracion;
    }
 
    public function insert(){
    	try {
    		global $pdo;
    		$query = '';
    		$query2 = '';
    		if(isset($this->pagodata_id))
    			$query.='pagodata_id, ';
    		if(isset($this->reserva_id))
    			$query.='reserva_id, ';
    		if(isset($this->pagodata_json))
    			$query.='pagodata_json, ';
    		if(isset($this->pagodata_integracion))
    			$query.='pagodata_integracion, ';
    		if(isset($this->pagodata_id))
    			$query2.=':pagodata_id, ';
    		if(isset($this->reserva_id))
    			$query2.=':reserva_id, ';
    		if(isset($this->pagodata_json))
    			$query2.=':pagodata_json, ';
    		if(isset($this->pagodata_integracion))
    			$query2.=':pagodata_integracion, ';
    		$query = substr($query, 0, strlen($query) - 2);
    		$query2 = substr($query2, 0, strlen($query2) - 2);

    		$stmt = $pdo->prepare('INSERT INTO pagodata('.$query.') VALUES('.$query2.')');

    		if(isset($this->pagodata_id))
    			$stmt->bindParam(':pagodata_id',	$this->pagodata_id,	PDO::PARAM_STR);
    		if(isset($this->reserva_id))
    			$stmt->bindParam(':reserva_id',	$this->reserva_id,	PDO::PARAM_STR);
    		if(isset($this->pagodata_json))
    			$stmt->bindParam(':pagodata_json',	$this->pagodata_json,	PDO::PARAM_STR);
    		if(isset($this->pagodata_integracion))
    			$stmt->bindParam(':pagodata_integracion',	$this->pagodata_integracion,	PDO::PARAM_STR);
    		$stmt->execute();
    		if($stmt->rowCount() === 1){
    			$id = $pdo->lastInsertId();
    			$this->pagodata_id = $id;
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
    		$query='UPDATE pagodata SET ';
    		if(isset($this->reserva_id))
    			$query.='reserva_id=:reserva_id, ';
    		if(isset($this->pagodata_json))
    			$query.='pagodata_json=:pagodata_json, ';
    		if(isset($this->pagodata_integracion))
    			$query.='pagodata_integracion=:pagodata_integracion, ';

    		if($query!='UPDATE pagodata SET ')
    			$query = substr($query, 0, strlen($query) - 2);
    		$query.=' WHERE pagodata_id=:pagodata_id';
    		$stmt = $pdo->prepare($query);

    		$stmt->bindParam(':pagodata_id',	$this->pagodata_id,	PDO::PARAM_STR);

    		if(isset($this->reserva_id))
    			$stmt->bindParam(':reserva_id',	$this->reserva_id,	PDO::PARAM_STR);
    		if(isset($this->pagodata_json))
    			$stmt->bindParam(':pagodata_json',	$this->pagodata_json,	PDO::PARAM_STR);
    		if(isset($this->pagodata_integracion))
    			$stmt->bindParam(':pagodata_integracion',	$this->pagodata_integracion,	PDO::PARAM_STR);
    		return $stmt->execute();
    	} catch (PDOException $e) {
    		echo 'Error: ' . $e->getMessage();
    		Utility::capture($e);
    	}
    }

 
    public function delete(){
    	try {
    		global $pdo;
    		$sql = 'DELETE FROM pagodata WHERE pagodata_id=:pagodata_id';
    		$stmt = $pdo->prepare($sql);
    		$stmt->bindParam(':pagodata_id',$this->pagodata_id, PDO::PARAM_STR);
    		$stmt->execute();
    		return $stmt->rowCount();
    	} catch (Exception $exc) {
    		echo $exc->getTraceAsString();
    		Utility::capture($exc);
    	}
    }
 
    public static function getById($pagodata_id){
    	global $pdo;
    	$sql = 'SELECT * FROM pagodata WHERE pagodata_id=:pagodata_id';
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':pagodata_id',$pagodata_id, PDO::PARAM_STR);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	if($row){
    		return new Pagodata($row);
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
 	  	$orderClause = ' ORDER by pagodata_id';
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
 	  	$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM pagodata '.$whereClause .' '.$orderClause.' ';
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
 	  	$stmt->setFetchMode(PDO::FETCH_CLASS, 'PagodataEntity');
 	  	$result = $pdo->query('SELECT FOUND_ROWS() AS totalCount');
 	  	$result->setFetchMode(PDO::FETCH_ASSOC);
 	  	$row = $result->fetch();
 	  	$tbases = array();
 	  	while($tbases = $stmt->fetch()){
 	  		$tbases_vector[] = $tbases;
 	  	}
 	  	return array('pagodata_array' =>$tbases_vector, 'totalCount'=>$row['totalCount']);
 	  	} catch (Exception $exc) {
 	  		echo $exc->getTraceAsString();
    		Utility::capture($exc);
 	  	}
 	  }
 
    public static function getTotalRows(){
    	$total_rows = 0;
    	try {
    		global $pdo;
    		$sql = 'select count(*) from  pagodata';
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
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Pagodata');
		$salida_vector = array();
		while ($obj = $stmt->fetch()) {
			$salida_vector[] = $obj;
		}
		return $salida_vector;
    }
}
?>