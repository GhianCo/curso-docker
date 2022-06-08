<?php 
class BloqueoEntity extends EntityBase implements DBOCrud { 
     function __construct($options = array()) { 
        parent::__construct($options);
    }
    public $bloqueo_id; 
    public $cancha_id; 
    public $cliente_id; 
    public $proveedor_id; 
    public $bloqueo_fecha; 
    public $bloqueo_fechareserva; 
    public $bloqueo_horainicio; 
    public $bloqueo_horafin; 

    public function getBloqueo_id(){ 
        return $this->bloqueo_id;
    }
    public function setBloqueo_id($bloqueo_id){ 
        $this->bloqueo_id = $bloqueo_id;
    }
    public function getCancha_id(){ 
        return $this->cancha_id;
    }
    public function setCancha_id($cancha_id){ 
        $this->cancha_id = $cancha_id;
    }
    public function getCliente_id(){ 
        return $this->cliente_id;
    }
    public function setCliente_id($cliente_id){ 
        $this->cliente_id = $cliente_id;
    }
    public function getProveedor_id(){ 
        return $this->proveedor_id;
    }
    public function setProveedor_id($proveedor_id){ 
        $this->proveedor_id = $proveedor_id;
    }
    public function getBloqueo_fecha(){ 
        return $this->bloqueo_fecha;
    }
    public function setBloqueo_fecha($bloqueo_fecha){ 
        $this->bloqueo_fecha = $bloqueo_fecha;
    }
    public function getBloqueo_fechareserva(){ 
        return $this->bloqueo_fechareserva;
    }
    public function setBloqueo_fechareserva($bloqueo_fechareserva){ 
        $this->bloqueo_fechareserva = $bloqueo_fechareserva;
    }
    public function getBloqueo_horainicio(){ 
        return $this->bloqueo_horainicio;
    }
    public function setBloqueo_horainicio($bloqueo_horainicio){ 
        $this->bloqueo_horainicio = $bloqueo_horainicio;
    }
    public function getBloqueo_horafin(){ 
        return $this->bloqueo_horafin;
    }
    public function setBloqueo_horafin($bloqueo_horafin){ 
        $this->bloqueo_horafin = $bloqueo_horafin;
    }
 
    public function insert(){
    	try {
    		global $pdo;
    		$query = '';
    		$query2 = '';
    		if(isset($this->bloqueo_id))
    			$query.='bloqueo_id, ';
    		if(isset($this->cancha_id))
    			$query.='cancha_id, ';
    		if(isset($this->cliente_id))
    			$query.='cliente_id, ';
    		if(isset($this->proveedor_id))
    			$query.='proveedor_id, ';
    		if(isset($this->bloqueo_fecha))
    			$query.='bloqueo_fecha, ';
    		if(isset($this->bloqueo_fechareserva))
    			$query.='bloqueo_fechareserva, ';
    		if(isset($this->bloqueo_horainicio))
    			$query.='bloqueo_horainicio, ';
    		if(isset($this->bloqueo_horafin))
    			$query.='bloqueo_horafin, ';
    		if(isset($this->bloqueo_id))
    			$query2.=':bloqueo_id, ';
    		if(isset($this->cancha_id))
    			$query2.=':cancha_id, ';
    		if(isset($this->cliente_id))
    			$query2.=':cliente_id, ';
    		if(isset($this->proveedor_id))
    			$query2.=':proveedor_id, ';
    		if(isset($this->bloqueo_fecha))
    			$query2.=':bloqueo_fecha, ';
    		if(isset($this->bloqueo_fechareserva))
    			$query2.=':bloqueo_fechareserva, ';
    		if(isset($this->bloqueo_horainicio))
    			$query2.=':bloqueo_horainicio, ';
    		if(isset($this->bloqueo_horafin))
    			$query2.=':bloqueo_horafin, ';
    		$query = substr($query, 0, strlen($query) - 2);
    		$query2 = substr($query2, 0, strlen($query2) - 2);

    		$stmt = $pdo->prepare('INSERT INTO bloqueo('.$query.') VALUES('.$query2.')');

    		if(isset($this->bloqueo_id))
    			$stmt->bindParam(':bloqueo_id',	$this->bloqueo_id,	PDO::PARAM_STR);
    		if(isset($this->cancha_id))
    			$stmt->bindParam(':cancha_id',	$this->cancha_id,	PDO::PARAM_STR);
    		if(isset($this->cliente_id))
    			$stmt->bindParam(':cliente_id',	$this->cliente_id,	PDO::PARAM_STR);
    		if(isset($this->proveedor_id))
    			$stmt->bindParam(':proveedor_id',	$this->proveedor_id,	PDO::PARAM_STR);
    		if(isset($this->bloqueo_fecha))
    			$stmt->bindParam(':bloqueo_fecha',	$this->bloqueo_fecha,	PDO::PARAM_STR);
    		if(isset($this->bloqueo_fechareserva))
    			$stmt->bindParam(':bloqueo_fechareserva',	$this->bloqueo_fechareserva,	PDO::PARAM_STR);
    		if(isset($this->bloqueo_horainicio))
    			$stmt->bindParam(':bloqueo_horainicio',	$this->bloqueo_horainicio,	PDO::PARAM_STR);
    		if(isset($this->bloqueo_horafin))
    			$stmt->bindParam(':bloqueo_horafin',	$this->bloqueo_horafin,	PDO::PARAM_STR);
    		$stmt->execute();
    		if($stmt->rowCount() === 1){
    			$id = $pdo->lastInsertId();
    			$this->bloqueo_id = $id;
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
    		$query='UPDATE bloqueo SET ';
    		if(isset($this->cancha_id))
    			$query.='cancha_id=:cancha_id, ';
    		if(isset($this->cliente_id))
    			$query.='cliente_id=:cliente_id, ';
    		if(isset($this->proveedor_id))
    			$query.='proveedor_id=:proveedor_id, ';
    		if(isset($this->bloqueo_fecha))
    			$query.='bloqueo_fecha=:bloqueo_fecha, ';
    		if(isset($this->bloqueo_fechareserva))
    			$query.='bloqueo_fechareserva=:bloqueo_fechareserva, ';
    		if(isset($this->bloqueo_horainicio))
    			$query.='bloqueo_horainicio=:bloqueo_horainicio, ';
    		if(isset($this->bloqueo_horafin))
    			$query.='bloqueo_horafin=:bloqueo_horafin, ';

    		if($query!='UPDATE bloqueo SET ')
    			$query = substr($query, 0, strlen($query) - 2);
    		$query.=' WHERE bloqueo_id=:bloqueo_id';
    		$stmt = $pdo->prepare($query);

    		$stmt->bindParam(':bloqueo_id',	$this->bloqueo_id,	PDO::PARAM_STR);

    		if(isset($this->cancha_id))
    			$stmt->bindParam(':cancha_id',	$this->cancha_id,	PDO::PARAM_STR);
    		if(isset($this->cliente_id))
    			$stmt->bindParam(':cliente_id',	$this->cliente_id,	PDO::PARAM_STR);
    		if(isset($this->proveedor_id))
    			$stmt->bindParam(':proveedor_id',	$this->proveedor_id,	PDO::PARAM_STR);
    		if(isset($this->bloqueo_fecha))
    			$stmt->bindParam(':bloqueo_fecha',	$this->bloqueo_fecha,	PDO::PARAM_STR);
    		if(isset($this->bloqueo_fechareserva))
    			$stmt->bindParam(':bloqueo_fechareserva',	$this->bloqueo_fechareserva,	PDO::PARAM_STR);
    		if(isset($this->bloqueo_horainicio))
    			$stmt->bindParam(':bloqueo_horainicio',	$this->bloqueo_horainicio,	PDO::PARAM_STR);
    		if(isset($this->bloqueo_horafin))
    			$stmt->bindParam(':bloqueo_horafin',	$this->bloqueo_horafin,	PDO::PARAM_STR);
    		return $stmt->execute();
    	} catch (PDOException $e) {
    		echo 'Error: ' . $e->getMessage();
    		Utility::capture($e);
    	}
    }

 
    public function delete(){
    	try {
    		global $pdo;
    		$sql = 'DELETE FROM bloqueo WHERE bloqueo_id=:bloqueo_id';
    		$stmt = $pdo->prepare($sql);
    		$stmt->bindParam(':bloqueo_id',$this->bloqueo_id, PDO::PARAM_STR);
    		$stmt->execute();
    		return $stmt->rowCount();
    	} catch (Exception $exc) {
    		echo $exc->getTraceAsString();
    		Utility::capture($exc);
    	}
    }
 
    public static function getById($bloqueo_id){
    	global $pdo;
    	$sql = 'SELECT * FROM bloqueo WHERE bloqueo_id=:bloqueo_id';
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':bloqueo_id',$bloqueo_id, PDO::PARAM_STR);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	if($row){
    		return new Bloqueo($row);
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
 	  	$orderClause = ' ORDER by bloqueo_id';
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
 	  	$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM bloqueo '.$whereClause .' '.$orderClause.' ';
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
 	  	$stmt->setFetchMode(PDO::FETCH_CLASS, 'BloqueoEntity');
 	  	$result = $pdo->query('SELECT FOUND_ROWS() AS totalCount');
 	  	$result->setFetchMode(PDO::FETCH_ASSOC);
 	  	$row = $result->fetch();
 	  	$tbases = array();
 	  	while($tbases = $stmt->fetch()){
 	  		$tbases_vector[] = $tbases;
 	  	}
 	  	return array('bloqueo_array' =>$tbases_vector, 'totalCount'=>$row['totalCount']);
 	  	} catch (Exception $exc) {
 	  		echo $exc->getTraceAsString();
    		Utility::capture($exc);
 	  	}
 	  }
 
    public static function getTotalRows(){
    	$total_rows = 0;
    	try {
    		global $pdo;
    		$sql = 'select count(*) from  bloqueo';
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
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Bloqueo');
		$salida_vector = array();
		while ($obj = $stmt->fetch()) {
			$salida_vector[] = $obj;
		}
		return $salida_vector;
    }
}
?>