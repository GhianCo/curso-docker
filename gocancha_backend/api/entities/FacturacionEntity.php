<?php 
class FacturacionEntity extends EntityBase implements DBOCrud { 
     function __construct($options = array()) { 
        parent::__construct($options);
    }
    public $facturacion_id; 
    public $proveedor_id; 
    public $facturacion_fechainicio; 
    public $facturacion_fechafin;
    public $facturacion_totalreservas; 
    public $facturacion_totalcomisiones; 
    public $facturacion_estado; 
    public $facturacion_urldeposito; 
    public $facturacion_fechapago;

    public function getFacturacion_id(){ 
        return $this->facturacion_id;
    }
    public function setFacturacion_id($facturacion_id){ 
        $this->facturacion_id = $facturacion_id;
    }
    public function getProveedor_id(){ 
        return $this->proveedor_id;
    }
    public function setProveedor_id($proveedor_id){ 
        $this->proveedor_id = $proveedor_id;
    }
    public function getFacturacion_fechainicio(){ 
        return $this->facturacion_fechainicio;
    }
    public function setFacturacion_fechainicio($facturacion_fechainicio){ 
        $this->facturacion_fechainicio = $facturacion_fechainicio;
    }
    public function getFacturacion_fechafin(){ 
        return $this->facturacion_fechafin;
    }
    public function setFacturacion_fechafin($facturacion_fechafin){ 
        $this->facturacion_fechafin = $facturacion_fechafin;
    }
    public function getFacturacion_totalreservas(){ 
        return $this->facturacion_totalreservas;
    }
    public function setFacturacion_totalreservas($facturacion_totalreservas){ 
        $this->facturacion_totalreservas = $facturacion_totalreservas;
    }
    public function getFacturacion_totalcomisiones(){ 
        return $this->facturacion_totalcomisiones;
    }
    public function setFacturacion_totalcomisiones($facturacion_totalcomisiones){ 
        $this->facturacion_totalcomisiones = $facturacion_totalcomisiones;
    }
    public function getFacturacion_estado(){ 
        return $this->facturacion_estado;
    }
    public function setFacturacion_estado($facturacion_estado){ 
        $this->facturacion_estado = $facturacion_estado;
    }
    public function getFacturacion_urldeposito(){ 
        return $this->facturacion_urldeposito;
    }
    public function setFacturacion_urldeposito($facturacion_urldeposito){ 
        $this->facturacion_urldeposito = $facturacion_urldeposito;
    }
 
    public function insert(){
    	try {
    		global $pdo;
    		$query = '';
    		$query2 = '';
    		if(isset($this->facturacion_id))
    			$query.='facturacion_id, ';
    		if(isset($this->proveedor_id))
    			$query.='proveedor_id, ';
    		if(isset($this->facturacion_fechainicio))
    			$query.='facturacion_fechainicio, ';
    		if(isset($this->facturacion_fechafin))
    			$query.='facturacion_fechafin, ';
    		if(isset($this->facturacion_fechapago))
    			$query.='facturacion_fechapago, ';
    		if(isset($this->facturacion_totalreservas))
    			$query.='facturacion_totalreservas, ';
    		if(isset($this->facturacion_totalcomisiones))
    			$query.='facturacion_totalcomisiones, ';
    		if(isset($this->facturacion_estado))
    			$query.='facturacion_estado, ';
    		if(isset($this->facturacion_urldeposito))
    			$query.='facturacion_urldeposito, ';
    		if(isset($this->facturacion_id))
    			$query2.=':facturacion_id, ';
    		if(isset($this->proveedor_id))
    			$query2.=':proveedor_id, ';
    		if(isset($this->facturacion_fechainicio))
    			$query2.=':facturacion_fechainicio, ';
    		if(isset($this->facturacion_fechafin))
    			$query2.=':facturacion_fechafin, ';
    		if(isset($this->facturacion_fechapago))
    			$query2.=':facturacion_fechapago, ';
    		if(isset($this->facturacion_totalreservas))
    			$query2.=':facturacion_totalreservas, ';
    		if(isset($this->facturacion_totalcomisiones))
    			$query2.=':facturacion_totalcomisiones, ';
    		if(isset($this->facturacion_estado))
    			$query2.=':facturacion_estado, ';
    		if(isset($this->facturacion_urldeposito))
    			$query2.=':facturacion_urldeposito, ';
    		$query = substr($query, 0, strlen($query) - 2);
    		$query2 = substr($query2, 0, strlen($query2) - 2);

    		$stmt = $pdo->prepare('INSERT INTO facturacion('.$query.') VALUES('.$query2.')');

    		if(isset($this->facturacion_id))
    			$stmt->bindParam(':facturacion_id',	$this->facturacion_id,	PDO::PARAM_STR);
    		if(isset($this->proveedor_id))
    			$stmt->bindParam(':proveedor_id',	$this->proveedor_id,	PDO::PARAM_STR);
    		if(isset($this->facturacion_fechainicio))
    			$stmt->bindParam(':facturacion_fechainicio',	$this->facturacion_fechainicio,	PDO::PARAM_STR);
    		if(isset($this->facturacion_fechafin))
    			$stmt->bindParam(':facturacion_fechafin',	$this->facturacion_fechafin,	PDO::PARAM_STR);
    		if(isset($this->facturacion_fechapago))
    			$stmt->bindParam(':facturacion_fechapago',	$this->facturacion_fechapago,	PDO::PARAM_STR);
    		if(isset($this->facturacion_totalreservas))
    			$stmt->bindParam(':facturacion_totalreservas',	$this->facturacion_totalreservas,	PDO::PARAM_STR);
    		if(isset($this->facturacion_totalcomisiones))
    			$stmt->bindParam(':facturacion_totalcomisiones',	$this->facturacion_totalcomisiones,	PDO::PARAM_STR);
    		if(isset($this->facturacion_estado))
    			$stmt->bindParam(':facturacion_estado',	$this->facturacion_estado,	PDO::PARAM_STR);
    		if(isset($this->facturacion_urldeposito))
    			$stmt->bindParam(':facturacion_urldeposito',	$this->facturacion_urldeposito,	PDO::PARAM_STR);
    		$stmt->execute();
    		if($stmt->rowCount() === 1){
    			return $pdo->lastInsertId();
    		}else{
    			return false;
    		}
    	} catch (PDOException $e) {
    		echo 'Error: ' . $e->getMessage() . '\n'. $e->getTraceAsString();
    	}
    }

 
    public function update(){
    	try {
    		global $pdo;
    		$query='UPDATE facturacion SET ';
    		if(isset($this->proveedor_id))
    			$query.='proveedor_id=:proveedor_id, ';
    		if(isset($this->facturacion_fechainicio))
    			$query.='facturacion_fechainicio=:facturacion_fechainicio, ';
    		if(isset($this->facturacion_fechafin))
    			$query.='facturacion_fechafin=:facturacion_fechafin, ';
    		if(isset($this->facturacion_fechapago))
    			$query.='facturacion_fechapago=:facturacion_fechapago, ';
    		if(isset($this->facturacion_totalreservas))
    			$query.='facturacion_totalreservas=:facturacion_totalreservas, ';
    		if(isset($this->facturacion_totalcomisiones))
    			$query.='facturacion_totalcomisiones=:facturacion_totalcomisiones, ';
    		if(isset($this->facturacion_estado))
    			$query.='facturacion_estado=:facturacion_estado, ';
    		if(isset($this->facturacion_urldeposito))
    			$query.='facturacion_urldeposito=:facturacion_urldeposito, ';

    		if($query!='UPDATE facturacion SET ')
    			$query = substr($query, 0, strlen($query) - 2);
    		$query.=' WHERE facturacion_id=:facturacion_id';
    		$stmt = $pdo->prepare($query);

    		$stmt->bindParam(':facturacion_id',	$this->facturacion_id,	PDO::PARAM_STR);

    		if(isset($this->proveedor_id))
    			$stmt->bindParam(':proveedor_id',	$this->proveedor_id,	PDO::PARAM_STR);
    		if(isset($this->facturacion_fechainicio))
    			$stmt->bindParam(':facturacion_fechainicio',	$this->facturacion_fechainicio,	PDO::PARAM_STR);
    		if(isset($this->facturacion_fechafin))
    			$stmt->bindParam(':facturacion_fechafin',	$this->facturacion_fechafin,	PDO::PARAM_STR);
    		if(isset($this->facturacion_fechapago))
    			$stmt->bindParam(':facturacion_fechapago',	$this->facturacion_fechapago,	PDO::PARAM_STR);
    		if(isset($this->facturacion_totalreservas))
    			$stmt->bindParam(':facturacion_totalreservas',	$this->facturacion_totalreservas,	PDO::PARAM_STR);
    		if(isset($this->facturacion_totalcomisiones))
    			$stmt->bindParam(':facturacion_totalcomisiones',	$this->facturacion_totalcomisiones,	PDO::PARAM_STR);
    		if(isset($this->facturacion_estado))
    			$stmt->bindParam(':facturacion_estado',	$this->facturacion_estado,	PDO::PARAM_STR);
    		if(isset($this->facturacion_urldeposito))
    			$stmt->bindParam(':facturacion_urldeposito',	$this->facturacion_urldeposito,	PDO::PARAM_STR);
    		return $stmt->execute();
    	} catch (PDOException $e) {
    		echo 'Error: ' . $e->getMessage();
    	}
    }

 
    public function delete(){
    	try {
    		global $pdo;
    		$sql = 'DELETE FROM facturacion WHERE facturacion_id=:facturacion_id';
    		$stmt = $pdo->prepare($sql);
    		$stmt->bindParam(':facturacion_id',$this->facturacion_id, PDO::PARAM_STR);
    		$stmt->execute();
    		return $stmt->rowCount();
    	} catch (Exception $exc) {
    		echo $exc->getTraceAsString();
    	}
    }
 
    public static function getById($facturacion_id){
    	global $pdo;
    	$sql = 'SELECT * FROM facturacion WHERE facturacion_id=:facturacion_id';
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':facturacion_id',$facturacion_id, PDO::PARAM_STR);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	if($row){
    		return new Facturacion($row);
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
 	  	$orderClause = ' ORDER by facturacion_id';
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
 	  	$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM facturacion '.$whereClause .' '.$orderClause.' ';
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
 	  	$stmt->setFetchMode(PDO::FETCH_CLASS, 'FacturacionEntity');
 	  	$result = $pdo->query('SELECT FOUND_ROWS() AS totalCount');
 	  	$result->setFetchMode(PDO::FETCH_ASSOC);
 	  	$row = $result->fetch();
 	  	$tbases = array();
 	  	while($tbases = $stmt->fetch()){
 	  		$tbases_vector[] = $tbases;
 	  	}
 	  	return array('facturacion_array' =>$tbases_vector, 'totalCount'=>$row['totalCount']);
 	  	} catch (Exception $exc) {
 	  		echo $exc->getTraceAsString();
 	  	}
 	  }
 
    public static function getTotalRows(){
    	$total_rows = 0;
    	try {
    		global $pdo;
    		$sql = 'select count(*) from  facturacion';
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
}
?>