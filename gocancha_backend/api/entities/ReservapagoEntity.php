<?php 
class ReservapagoEntity extends EntityBase implements DBOCrud { 
     function __construct($options = array()) { 
        parent::__construct($options);
    }
    public $reservapago_id; 
    public $reserva_id; 
    public $reservapago_monto; 
    public $reservapago_fecha; 
    public $reservapago_tipo; 

    public function getReservapago_id(){ 
        return $this->reservapago_id;
    }
    public function setReservapago_id($reservapago_id){ 
        $this->reservapago_id = $reservapago_id;
    }
    public function getReserva_id(){ 
        return $this->reserva_id;
    }
    public function setReserva_id($reserva_id){ 
        $this->reserva_id = $reserva_id;
    }
    public function getReservapago_monto(){ 
        return $this->reservapago_monto;
    }
    public function setReservapago_monto($reservapago_monto){ 
        $this->reservapago_monto = $reservapago_monto;
    }
    public function getReservapago_fecha(){ 
        return $this->reservapago_fecha;
    }
    public function setReservapago_fecha($reservapago_fecha){ 
        $this->reservapago_fecha = $reservapago_fecha;
    }
    public function getReservapago_tipo(){ 
        return $this->reservapago_tipo;
    }
    public function setReservapago_tipo($reservapago_tipo){ 
        $this->reservapago_tipo = $reservapago_tipo;
    }
 
    public function insert(){
    	try {
    		global $pdo;
    		$query = '';
    		$query2 = '';
    		if(isset($this->reservapago_id))
    			$query.='reservapago_id, ';
    		if(isset($this->reserva_id))
    			$query.='reserva_id, ';
    		if(isset($this->reservapago_monto))
    			$query.='reservapago_monto, ';
    		if(isset($this->reservapago_fecha))
    			$query.='reservapago_fecha, ';
    		if(isset($this->reservapago_tipo))
    			$query.='reservapago_tipo, ';
    		if(isset($this->reservapago_id))
    			$query2.=':reservapago_id, ';
    		if(isset($this->reserva_id))
    			$query2.=':reserva_id, ';
    		if(isset($this->reservapago_monto))
    			$query2.=':reservapago_monto, ';
    		if(isset($this->reservapago_fecha))
    			$query2.=':reservapago_fecha, ';
    		if(isset($this->reservapago_tipo))
    			$query2.=':reservapago_tipo, ';
    		$query = substr($query, 0, strlen($query) - 2);
    		$query2 = substr($query2, 0, strlen($query2) - 2);

    		$stmt = $pdo->prepare('INSERT INTO reservapago('.$query.') VALUES('.$query2.')');

    		if(isset($this->reservapago_id))
    			$stmt->bindParam(':reservapago_id',	$this->reservapago_id,	PDO::PARAM_STR);
    		if(isset($this->reserva_id))
    			$stmt->bindParam(':reserva_id',	$this->reserva_id,	PDO::PARAM_STR);
    		if(isset($this->reservapago_monto))
    			$stmt->bindParam(':reservapago_monto',	$this->reservapago_monto,	PDO::PARAM_STR);
    		if(isset($this->reservapago_fecha))
    			$stmt->bindParam(':reservapago_fecha',	$this->reservapago_fecha,	PDO::PARAM_STR);
    		if(isset($this->reservapago_tipo))
    			$stmt->bindParam(':reservapago_tipo',	$this->reservapago_tipo,	PDO::PARAM_STR);
    		$stmt->execute();
    		if($stmt->rowCount() === 1){
    			$id = $pdo->lastInsertId();
    			$this->reservapago_id = $id;
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
    		$query='UPDATE reservapago SET ';
    		if(isset($this->reserva_id))
    			$query.='reserva_id=:reserva_id, ';
    		if(isset($this->reservapago_monto))
    			$query.='reservapago_monto=:reservapago_monto, ';
    		if(isset($this->reservapago_fecha))
    			$query.='reservapago_fecha=:reservapago_fecha, ';
    		if(isset($this->reservapago_tipo))
    			$query.='reservapago_tipo=:reservapago_tipo, ';

    		if($query!='UPDATE reservapago SET ')
    			$query = substr($query, 0, strlen($query) - 2);
    		$query.=' WHERE reservapago_id=:reservapago_id';
    		$stmt = $pdo->prepare($query);

    		$stmt->bindParam(':reservapago_id',	$this->reservapago_id,	PDO::PARAM_STR);

    		if(isset($this->reserva_id))
    			$stmt->bindParam(':reserva_id',	$this->reserva_id,	PDO::PARAM_STR);
    		if(isset($this->reservapago_monto))
    			$stmt->bindParam(':reservapago_monto',	$this->reservapago_monto,	PDO::PARAM_STR);
    		if(isset($this->reservapago_fecha))
    			$stmt->bindParam(':reservapago_fecha',	$this->reservapago_fecha,	PDO::PARAM_STR);
    		if(isset($this->reservapago_tipo))
    			$stmt->bindParam(':reservapago_tipo',	$this->reservapago_tipo,	PDO::PARAM_STR);
    		return $stmt->execute();
    	} catch (PDOException $e) {
    		echo 'Error: ' . $e->getMessage();
    		Utility::capture($e);
    	}
    }

 
    public function delete(){
    	try {
    		global $pdo;
    		$sql = 'DELETE FROM reservapago WHERE reservapago_id=:reservapago_id';
    		$stmt = $pdo->prepare($sql);
    		$stmt->bindParam(':reservapago_id',$this->reservapago_id, PDO::PARAM_STR);
    		$stmt->execute();
    		return $stmt->rowCount();
    	} catch (Exception $exc) {
    		echo $exc->getTraceAsString();
    		Utility::capture($exc);
    	}
    }
 
    public static function getById($reservapago_id){
    	global $pdo;
    	$sql = 'SELECT * FROM reservapago WHERE reservapago_id=:reservapago_id';
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':reservapago_id',$reservapago_id, PDO::PARAM_STR);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	if($row){
    		return new Reservapago($row);
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
 	  	$orderClause = ' ORDER by reservapago_id';
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
 	  	$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM reservapago '.$whereClause .' '.$orderClause.' ';
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
 	  	$stmt->setFetchMode(PDO::FETCH_CLASS, 'ReservapagoEntity');
 	  	$result = $pdo->query('SELECT FOUND_ROWS() AS totalCount');
 	  	$result->setFetchMode(PDO::FETCH_ASSOC);
 	  	$row = $result->fetch();
 	  	$tbases = array();
 	  	while($tbases = $stmt->fetch()){
 	  		$tbases_vector[] = $tbases;
 	  	}
 	  	return array('reservapago_array' =>$tbases_vector, 'totalCount'=>$row['totalCount']);
 	  	} catch (Exception $exc) {
 	  		echo $exc->getTraceAsString();
    		Utility::capture($exc);
 	  	}
 	  }
 
    public static function getTotalRows(){
    	$total_rows = 0;
    	try {
    		global $pdo;
    		$sql = 'select count(*) from  reservapago';
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
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Reservapago');
		$salida_vector = array();
		while ($obj = $stmt->fetch()) {
			$salida_vector[] = $obj;
		}
		return $salida_vector;
    }
}
?>