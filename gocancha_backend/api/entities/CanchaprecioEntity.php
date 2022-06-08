<?php 
class CanchaprecioEntity extends EntityBase implements DBOCrud { 
     function __construct($options = array()) { 
        parent::__construct($options);
    }
    public $canchaprecio_id; 
    public $cancha_id; 
    public $canchaprecio_valor; 
    public $canchaprecio_dia; 
    public $canchaprecio_horainicio; 
    public $canchaprecio_horafin; 
    public $canchaprecio_estado; 
    public $canchaprecio_valoroferta; 
    public $canchaprecio_horainiciooferta; 
    public $canchaprecio_horafinoferta; 

    public function getCanchaprecio_id(){ 
        return $this->canchaprecio_id;
    }
    public function setCanchaprecio_id($canchaprecio_id){ 
        $this->canchaprecio_id = $canchaprecio_id;
    }
    public function getCancha_id(){ 
        return $this->cancha_id;
    }
    public function setCancha_id($cancha_id){ 
        $this->cancha_id = $cancha_id;
    }
    public function getCanchaprecio_valor(){ 
        return $this->canchaprecio_valor;
    }
    public function setCanchaprecio_valor($canchaprecio_valor){ 
        $this->canchaprecio_valor = $canchaprecio_valor;
    }
    public function getCanchaprecio_dia(){ 
        return $this->canchaprecio_dia;
    }
    public function setCanchaprecio_dia($canchaprecio_dia){ 
        $this->canchaprecio_dia = $canchaprecio_dia;
    }
    public function getCanchaprecio_horainicio(){ 
        return $this->canchaprecio_horainicio;
    }
    public function setCanchaprecio_horainicio($canchaprecio_horainicio){ 
        $this->canchaprecio_horainicio = $canchaprecio_horainicio;
    }
    public function getCanchaprecio_horafin(){ 
        return $this->canchaprecio_horafin;
    }
    public function setCanchaprecio_horafin($canchaprecio_horafin){ 
        $this->canchaprecio_horafin = $canchaprecio_horafin;
    }
    public function getCanchaprecio_estado(){ 
        return $this->canchaprecio_estado;
    }
    public function setCanchaprecio_estado($canchaprecio_estado){ 
        $this->canchaprecio_estado = $canchaprecio_estado;
    }
    public function getCanchaprecio_valoroferta(){ 
        return $this->canchaprecio_valoroferta;
    }
    public function setCanchaprecio_valoroferta($canchaprecio_valoroferta){ 
        $this->canchaprecio_valoroferta = $canchaprecio_valoroferta;
    }
    public function getCanchaprecio_horainiciooferta(){ 
        return $this->canchaprecio_horainiciooferta;
    }
    public function setCanchaprecio_horainiciooferta($canchaprecio_horainiciooferta){ 
        $this->canchaprecio_horainiciooferta = $canchaprecio_horainiciooferta;
    }
    public function getCanchaprecio_horafinoferta(){ 
        return $this->canchaprecio_horafinoferta;
    }
    public function setCanchaprecio_horafinoferta($canchaprecio_horafinoferta){ 
        $this->canchaprecio_horafinoferta = $canchaprecio_horafinoferta;
    }
 
    public function insert(){
    	try {
    		global $pdo;
    		$query = '';
    		$query2 = '';
    		if(isset($this->canchaprecio_id))
    			$query.='canchaprecio_id, ';
    		if(isset($this->cancha_id))
    			$query.='cancha_id, ';
    		if(isset($this->canchaprecio_valor))
    			$query.='canchaprecio_valor, ';
    		if(isset($this->canchaprecio_dia))
    			$query.='canchaprecio_dia, ';
    		if(isset($this->canchaprecio_horainicio))
    			$query.='canchaprecio_horainicio, ';
    		if(isset($this->canchaprecio_horafin))
    			$query.='canchaprecio_horafin, ';
    		if(isset($this->canchaprecio_estado))
    			$query.='canchaprecio_estado, ';
    		if(isset($this->canchaprecio_valoroferta))
    			$query.='canchaprecio_valoroferta, ';
    		if(isset($this->canchaprecio_horainiciooferta))
    			$query.='canchaprecio_horainiciooferta, ';
    		if(isset($this->canchaprecio_horafinoferta))
    			$query.='canchaprecio_horafinoferta, ';
    		if(isset($this->canchaprecio_id))
    			$query2.=':canchaprecio_id, ';
    		if(isset($this->cancha_id))
    			$query2.=':cancha_id, ';
    		if(isset($this->canchaprecio_valor))
    			$query2.=':canchaprecio_valor, ';
    		if(isset($this->canchaprecio_dia))
    			$query2.=':canchaprecio_dia, ';
    		if(isset($this->canchaprecio_horainicio))
    			$query2.=':canchaprecio_horainicio, ';
    		if(isset($this->canchaprecio_horafin))
    			$query2.=':canchaprecio_horafin, ';
    		if(isset($this->canchaprecio_estado))
    			$query2.=':canchaprecio_estado, ';
    		if(isset($this->canchaprecio_valoroferta))
    			$query2.=':canchaprecio_valoroferta, ';
    		if(isset($this->canchaprecio_horainiciooferta))
    			$query2.=':canchaprecio_horainiciooferta, ';
    		if(isset($this->canchaprecio_horafinoferta))
    			$query2.=':canchaprecio_horafinoferta, ';
    		$query = substr($query, 0, strlen($query) - 2);
    		$query2 = substr($query2, 0, strlen($query2) - 2);

    		$stmt = $pdo->prepare('INSERT INTO canchaprecio('.$query.') VALUES('.$query2.')');

    		if(isset($this->canchaprecio_id))
    			$stmt->bindParam(':canchaprecio_id',	$this->canchaprecio_id,	PDO::PARAM_STR);
    		if(isset($this->cancha_id))
    			$stmt->bindParam(':cancha_id',	$this->cancha_id,	PDO::PARAM_STR);
    		if(isset($this->canchaprecio_valor))
    			$stmt->bindParam(':canchaprecio_valor',	$this->canchaprecio_valor,	PDO::PARAM_STR);
    		if(isset($this->canchaprecio_dia))
    			$stmt->bindParam(':canchaprecio_dia',	$this->canchaprecio_dia,	PDO::PARAM_STR);
    		if(isset($this->canchaprecio_horainicio))
    			$stmt->bindParam(':canchaprecio_horainicio',	$this->canchaprecio_horainicio,	PDO::PARAM_STR);
    		if(isset($this->canchaprecio_horafin))
    			$stmt->bindParam(':canchaprecio_horafin',	$this->canchaprecio_horafin,	PDO::PARAM_STR);
    		if(isset($this->canchaprecio_estado))
    			$stmt->bindParam(':canchaprecio_estado',	$this->canchaprecio_estado,	PDO::PARAM_STR);
    		if(isset($this->canchaprecio_valoroferta))
    			$stmt->bindParam(':canchaprecio_valoroferta',	$this->canchaprecio_valoroferta,	PDO::PARAM_STR);
    		if(isset($this->canchaprecio_horainiciooferta))
    			$stmt->bindParam(':canchaprecio_horainiciooferta',	$this->canchaprecio_horainiciooferta,	PDO::PARAM_STR);
    		if(isset($this->canchaprecio_horafinoferta))
    			$stmt->bindParam(':canchaprecio_horafinoferta',	$this->canchaprecio_horafinoferta,	PDO::PARAM_STR);
    		$stmt->execute();
    		if($stmt->rowCount() === 1){
    			$id = $pdo->lastInsertId();
    			$this->canchaprecio_id = $id;
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
    		$query='UPDATE canchaprecio SET ';
    		if(isset($this->cancha_id))
    			$query.='cancha_id=:cancha_id, ';
    		if(isset($this->canchaprecio_valor))
    			$query.='canchaprecio_valor=:canchaprecio_valor, ';
    		if(isset($this->canchaprecio_dia))
    			$query.='canchaprecio_dia=:canchaprecio_dia, ';
    		if(isset($this->canchaprecio_horainicio))
    			$query.='canchaprecio_horainicio=:canchaprecio_horainicio, ';
    		if(isset($this->canchaprecio_horafin))
    			$query.='canchaprecio_horafin=:canchaprecio_horafin, ';
    		if(isset($this->canchaprecio_estado))
    			$query.='canchaprecio_estado=:canchaprecio_estado, ';
    		if(isset($this->canchaprecio_valoroferta))
    			$query.='canchaprecio_valoroferta=:canchaprecio_valoroferta, ';
    		if(isset($this->canchaprecio_horainiciooferta))
    			$query.='canchaprecio_horainiciooferta=:canchaprecio_horainiciooferta, ';
    		if(isset($this->canchaprecio_horafinoferta))
    			$query.='canchaprecio_horafinoferta=:canchaprecio_horafinoferta, ';

    		if($query!='UPDATE canchaprecio SET ')
    			$query = substr($query, 0, strlen($query) - 2);
    		$query.=' WHERE canchaprecio_id=:canchaprecio_id';
    		$stmt = $pdo->prepare($query);

    		$stmt->bindParam(':canchaprecio_id',	$this->canchaprecio_id,	PDO::PARAM_STR);

    		if(isset($this->cancha_id))
    			$stmt->bindParam(':cancha_id',	$this->cancha_id,	PDO::PARAM_STR);
    		if(isset($this->canchaprecio_valor))
    			$stmt->bindParam(':canchaprecio_valor',	$this->canchaprecio_valor,	PDO::PARAM_STR);
    		if(isset($this->canchaprecio_dia))
    			$stmt->bindParam(':canchaprecio_dia',	$this->canchaprecio_dia,	PDO::PARAM_STR);
    		if(isset($this->canchaprecio_horainicio))
    			$stmt->bindParam(':canchaprecio_horainicio',	$this->canchaprecio_horainicio,	PDO::PARAM_STR);
    		if(isset($this->canchaprecio_horafin))
    			$stmt->bindParam(':canchaprecio_horafin',	$this->canchaprecio_horafin,	PDO::PARAM_STR);
    		if(isset($this->canchaprecio_estado))
    			$stmt->bindParam(':canchaprecio_estado',	$this->canchaprecio_estado,	PDO::PARAM_STR);
    		if(isset($this->canchaprecio_valoroferta))
    			$stmt->bindParam(':canchaprecio_valoroferta',	$this->canchaprecio_valoroferta,	PDO::PARAM_STR);
    		if(isset($this->canchaprecio_horainiciooferta))
    			$stmt->bindParam(':canchaprecio_horainiciooferta',	$this->canchaprecio_horainiciooferta,	PDO::PARAM_STR);
    		if(isset($this->canchaprecio_horafinoferta))
    			$stmt->bindParam(':canchaprecio_horafinoferta',	$this->canchaprecio_horafinoferta,	PDO::PARAM_STR);
    		return $stmt->execute();
    	} catch (PDOException $e) {
    		echo 'Error: ' . $e->getMessage();
    		Utility::capture($e);
    	}
    }

 
    public function delete(){
    	try {
    		global $pdo;
    		$sql = 'DELETE FROM canchaprecio WHERE canchaprecio_id=:canchaprecio_id';
    		$stmt = $pdo->prepare($sql);
    		$stmt->bindParam(':canchaprecio_id',$this->canchaprecio_id, PDO::PARAM_STR);
    		$stmt->execute();
    		return $stmt->rowCount();
    	} catch (Exception $exc) {
    		echo $exc->getTraceAsString();
    		Utility::capture($exc);
    	}
    }
 
    public static function getById($canchaprecio_id){
    	global $pdo;
    	$sql = 'SELECT * FROM canchaprecio WHERE canchaprecio_id=:canchaprecio_id';
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':canchaprecio_id',$canchaprecio_id, PDO::PARAM_STR);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	if($row){
    		return new Canchaprecio($row);
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
 	  	$orderClause = ' ORDER by canchaprecio_id';
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
 	  	$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM canchaprecio '.$whereClause .' '.$orderClause.' ';
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
 	  	$stmt->setFetchMode(PDO::FETCH_CLASS, 'CanchaprecioEntity');
 	  	$result = $pdo->query('SELECT FOUND_ROWS() AS totalCount');
 	  	$result->setFetchMode(PDO::FETCH_ASSOC);
 	  	$row = $result->fetch();
 	  	$tbases = array();
 	  	while($tbases = $stmt->fetch()){
 	  		$tbases_vector[] = $tbases;
 	  	}
 	  	return array('canchaprecio_array' =>$tbases_vector, 'totalCount'=>$row['totalCount']);
 	  	} catch (Exception $exc) {
 	  		echo $exc->getTraceAsString();
    		Utility::capture($exc);
 	  	}
 	  }
 
    public static function getTotalRows(){
    	$total_rows = 0;
    	try {
    		global $pdo;
    		$sql = 'select count(*) from  canchaprecio';
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
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Canchaprecio');
		$salida_vector = array();
		while ($obj = $stmt->fetch()) {
			$salida_vector[] = $obj;
		}
		return $salida_vector;
    }
}
?>