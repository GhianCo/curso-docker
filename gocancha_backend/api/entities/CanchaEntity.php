<?php 
class CanchaEntity extends EntityBase implements DBOCrud { 
     function __construct($options = array()) { 
        parent::__construct($options);
    }
    public $cancha_id; 
    public $deporte_id; 
    public $proveedor_id; 
    public $cancha_nombre; 
    public $cancha_precio; 
    public $cancha_tipo; 
    public $cancha_size; 
    public $cancha_estado; 
    public $cancha_urllogo; 
    public $cancha_usapreciohora; 
    public $cancha_inicio; 
    public $cancha_fin; 
    public $cancha_preciohora; 
    public $cancha_padreid; 

    public function getCancha_id(){ 
        return $this->cancha_id;
    }
    public function setCancha_id($cancha_id){ 
        $this->cancha_id = $cancha_id;
    }
    public function getDeporte_id(){ 
        return $this->deporte_id;
    }
    public function setDeporte_id($deporte_id){ 
        $this->deporte_id = $deporte_id;
    }
    public function getProveedor_id(){ 
        return $this->proveedor_id;
    }
    public function setProveedor_id($proveedor_id){ 
        $this->proveedor_id = $proveedor_id;
    }
    public function getCancha_nombre(){ 
        return $this->cancha_nombre;
    }
    public function setCancha_nombre($cancha_nombre){ 
        $this->cancha_nombre = $cancha_nombre;
    }
    public function getCancha_precio(){ 
        return $this->cancha_precio;
    }
    public function setCancha_precio($cancha_precio){ 
        $this->cancha_precio = $cancha_precio;
    }
    public function getCancha_tipo(){ 
        return $this->cancha_tipo;
    }
    public function setCancha_tipo($cancha_tipo){ 
        $this->cancha_tipo = $cancha_tipo;
    }
    public function getCancha_size(){ 
        return $this->cancha_size;
    }
    public function setCancha_size($cancha_size){ 
        $this->cancha_size = $cancha_size;
    }
    public function getCancha_estado(){ 
        return $this->cancha_estado;
    }
    public function setCancha_estado($cancha_estado){ 
        $this->cancha_estado = $cancha_estado;
    }
    public function getCancha_urllogo(){ 
        return $this->cancha_urllogo;
    }
    public function setCancha_urllogo($cancha_urllogo){ 
        $this->cancha_urllogo = $cancha_urllogo;
    }
    public function getCancha_usapreciohora(){ 
        return $this->cancha_usapreciohora;
    }
    public function setCancha_usapreciohora($cancha_usapreciohora){ 
        $this->cancha_usapreciohora = $cancha_usapreciohora;
    }
    public function getCancha_inicio(){ 
        return $this->cancha_inicio;
    }
    public function setCancha_inicio($cancha_inicio){ 
        $this->cancha_inicio = $cancha_inicio;
    }
    public function getCancha_fin(){ 
        return $this->cancha_fin;
    }
    public function setCancha_fin($cancha_fin){ 
        $this->cancha_fin = $cancha_fin;
    }
    public function getCancha_preciohora(){ 
        return $this->cancha_preciohora;
    }
    public function setCancha_preciohora($cancha_preciohora){ 
        $this->cancha_preciohora = $cancha_preciohora;
    }
    public function getCancha_padreid(){ 
        return $this->cancha_padreid;
    }
    public function setCancha_padreid($cancha_padreid){ 
        $this->cancha_padreid = $cancha_padreid;
    }
 
    public function insert(){
    	try {
    		global $pdo;
    		$query = '';
    		$query2 = '';
    		if(isset($this->cancha_id))
    			$query.='cancha_id, ';
    		if(isset($this->deporte_id))
    			$query.='deporte_id, ';
    		if(isset($this->proveedor_id))
    			$query.='proveedor_id, ';
    		if(isset($this->cancha_nombre))
    			$query.='cancha_nombre, ';
    		if(isset($this->cancha_precio))
    			$query.='cancha_precio, ';
    		if(isset($this->cancha_tipo))
    			$query.='cancha_tipo, ';
    		if(isset($this->cancha_size))
    			$query.='cancha_size, ';
    		if(isset($this->cancha_estado))
    			$query.='cancha_estado, ';
    		if(isset($this->cancha_urllogo))
    			$query.='cancha_urllogo, ';
    		if(isset($this->cancha_usapreciohora))
    			$query.='cancha_usapreciohora, ';
    		if(isset($this->cancha_inicio))
    			$query.='cancha_inicio, ';
    		if(isset($this->cancha_fin))
    			$query.='cancha_fin, ';
    		if(isset($this->cancha_preciohora))
    			$query.='cancha_preciohora, ';
    		if(isset($this->cancha_padreid))
    			$query.='cancha_padreid, ';
    		if(isset($this->cancha_id))
    			$query2.=':cancha_id, ';
    		if(isset($this->deporte_id))
    			$query2.=':deporte_id, ';
    		if(isset($this->proveedor_id))
    			$query2.=':proveedor_id, ';
    		if(isset($this->cancha_nombre))
    			$query2.=':cancha_nombre, ';
    		if(isset($this->cancha_precio))
    			$query2.=':cancha_precio, ';
    		if(isset($this->cancha_tipo))
    			$query2.=':cancha_tipo, ';
    		if(isset($this->cancha_size))
    			$query2.=':cancha_size, ';
    		if(isset($this->cancha_estado))
    			$query2.=':cancha_estado, ';
    		if(isset($this->cancha_urllogo))
    			$query2.=':cancha_urllogo, ';
    		if(isset($this->cancha_usapreciohora))
    			$query2.=':cancha_usapreciohora, ';
    		if(isset($this->cancha_inicio))
    			$query2.=':cancha_inicio, ';
    		if(isset($this->cancha_fin))
    			$query2.=':cancha_fin, ';
    		if(isset($this->cancha_preciohora))
    			$query2.=':cancha_preciohora, ';
    		if(isset($this->cancha_padreid))
    			$query2.=':cancha_padreid, ';
    		$query = substr($query, 0, strlen($query) - 2);
    		$query2 = substr($query2, 0, strlen($query2) - 2);

    		$stmt = $pdo->prepare('INSERT INTO cancha('.$query.') VALUES('.$query2.')');

    		if(isset($this->cancha_id))
    			$stmt->bindParam(':cancha_id',	$this->cancha_id,	PDO::PARAM_STR);
    		if(isset($this->deporte_id))
    			$stmt->bindParam(':deporte_id',	$this->deporte_id,	PDO::PARAM_STR);
    		if(isset($this->proveedor_id))
    			$stmt->bindParam(':proveedor_id',	$this->proveedor_id,	PDO::PARAM_STR);
    		if(isset($this->cancha_nombre))
    			$stmt->bindParam(':cancha_nombre',	$this->cancha_nombre,	PDO::PARAM_STR);
    		if(isset($this->cancha_precio))
    			$stmt->bindParam(':cancha_precio',	$this->cancha_precio,	PDO::PARAM_STR);
    		if(isset($this->cancha_tipo))
    			$stmt->bindParam(':cancha_tipo',	$this->cancha_tipo,	PDO::PARAM_STR);
    		if(isset($this->cancha_size))
    			$stmt->bindParam(':cancha_size',	$this->cancha_size,	PDO::PARAM_STR);
    		if(isset($this->cancha_estado))
    			$stmt->bindParam(':cancha_estado',	$this->cancha_estado,	PDO::PARAM_STR);
    		if(isset($this->cancha_urllogo))
    			$stmt->bindParam(':cancha_urllogo',	$this->cancha_urllogo,	PDO::PARAM_STR);
    		if(isset($this->cancha_usapreciohora))
    			$stmt->bindParam(':cancha_usapreciohora',	$this->cancha_usapreciohora,	PDO::PARAM_STR);
    		if(isset($this->cancha_inicio))
    			$stmt->bindParam(':cancha_inicio',	$this->cancha_inicio,	PDO::PARAM_STR);
    		if(isset($this->cancha_fin))
    			$stmt->bindParam(':cancha_fin',	$this->cancha_fin,	PDO::PARAM_STR);
    		if(isset($this->cancha_preciohora))
    			$stmt->bindParam(':cancha_preciohora',	$this->cancha_preciohora,	PDO::PARAM_STR);
    		if(isset($this->cancha_padreid))
    			$stmt->bindParam(':cancha_padreid',	$this->cancha_padreid,	PDO::PARAM_STR);
    		$stmt->execute();
    		if($stmt->rowCount() === 1){
    			$id = $pdo->lastInsertId();
    			$this->cancha_id = $id;
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
    		$query='UPDATE cancha SET ';
    		if(isset($this->deporte_id))
    			$query.='deporte_id=:deporte_id, ';
    		if(isset($this->proveedor_id))
    			$query.='proveedor_id=:proveedor_id, ';
    		if(isset($this->cancha_nombre))
    			$query.='cancha_nombre=:cancha_nombre, ';
    		if(isset($this->cancha_precio))
    			$query.='cancha_precio=:cancha_precio, ';
    		if(isset($this->cancha_tipo))
    			$query.='cancha_tipo=:cancha_tipo, ';
    		if(isset($this->cancha_size))
    			$query.='cancha_size=:cancha_size, ';
    		if(isset($this->cancha_estado))
    			$query.='cancha_estado=:cancha_estado, ';
    		if(isset($this->cancha_urllogo))
    			$query.='cancha_urllogo=:cancha_urllogo, ';
    		if(isset($this->cancha_usapreciohora))
    			$query.='cancha_usapreciohora=:cancha_usapreciohora, ';
    		if(isset($this->cancha_inicio))
    			$query.='cancha_inicio=:cancha_inicio, ';
    		if(isset($this->cancha_fin))
    			$query.='cancha_fin=:cancha_fin, ';
    		if(isset($this->cancha_preciohora))
    			$query.='cancha_preciohora=:cancha_preciohora, ';
    		if(isset($this->cancha_padreid))
    			$query.='cancha_padreid=:cancha_padreid, ';

    		if($query!='UPDATE cancha SET ')
    			$query = substr($query, 0, strlen($query) - 2);
    		$query.=' WHERE cancha_id=:cancha_id';
    		$stmt = $pdo->prepare($query);

    		$stmt->bindParam(':cancha_id',	$this->cancha_id,	PDO::PARAM_STR);

    		if(isset($this->deporte_id))
    			$stmt->bindParam(':deporte_id',	$this->deporte_id,	PDO::PARAM_STR);
    		if(isset($this->proveedor_id))
    			$stmt->bindParam(':proveedor_id',	$this->proveedor_id,	PDO::PARAM_STR);
    		if(isset($this->cancha_nombre))
    			$stmt->bindParam(':cancha_nombre',	$this->cancha_nombre,	PDO::PARAM_STR);
    		if(isset($this->cancha_precio))
    			$stmt->bindParam(':cancha_precio',	$this->cancha_precio,	PDO::PARAM_STR);
    		if(isset($this->cancha_tipo))
    			$stmt->bindParam(':cancha_tipo',	$this->cancha_tipo,	PDO::PARAM_STR);
    		if(isset($this->cancha_size))
    			$stmt->bindParam(':cancha_size',	$this->cancha_size,	PDO::PARAM_STR);
    		if(isset($this->cancha_estado))
    			$stmt->bindParam(':cancha_estado',	$this->cancha_estado,	PDO::PARAM_STR);
    		if(isset($this->cancha_urllogo))
    			$stmt->bindParam(':cancha_urllogo',	$this->cancha_urllogo,	PDO::PARAM_STR);
    		if(isset($this->cancha_usapreciohora))
    			$stmt->bindParam(':cancha_usapreciohora',	$this->cancha_usapreciohora,	PDO::PARAM_STR);
    		if(isset($this->cancha_inicio))
    			$stmt->bindParam(':cancha_inicio',	$this->cancha_inicio,	PDO::PARAM_STR);
    		if(isset($this->cancha_fin))
    			$stmt->bindParam(':cancha_fin',	$this->cancha_fin,	PDO::PARAM_STR);
    		if(isset($this->cancha_preciohora))
    			$stmt->bindParam(':cancha_preciohora',	$this->cancha_preciohora,	PDO::PARAM_STR);
    		if(isset($this->cancha_padreid))
    			$stmt->bindParam(':cancha_padreid',	$this->cancha_padreid,	PDO::PARAM_STR);
    		return $stmt->execute();
    	} catch (PDOException $e) {
    		echo 'Error: ' . $e->getMessage();
    		Utility::capture($e);
    	}
    }

 
    public function delete(){
    	try {
    		global $pdo;
    		$sql = 'DELETE FROM cancha WHERE cancha_id=:cancha_id';
    		$stmt = $pdo->prepare($sql);
    		$stmt->bindParam(':cancha_id',$this->cancha_id, PDO::PARAM_STR);
    		$stmt->execute();
    		return $stmt->rowCount();
    	} catch (Exception $exc) {
    		echo $exc->getTraceAsString();
    		Utility::capture($exc);
    	}
    }
 
    public static function getById($cancha_id){
    	global $pdo;
    	$sql = 'SELECT * FROM cancha WHERE cancha_id=:cancha_id';
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':cancha_id',$cancha_id, PDO::PARAM_STR);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	if($row){
    		return new Cancha($row);
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
 	  	$orderClause = ' ORDER by cancha_id';
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
 	  	$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM cancha '.$whereClause .' '.$orderClause.' ';
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
 	  	$stmt->setFetchMode(PDO::FETCH_CLASS, 'CanchaEntity');
 	  	$result = $pdo->query('SELECT FOUND_ROWS() AS totalCount');
 	  	$result->setFetchMode(PDO::FETCH_ASSOC);
 	  	$row = $result->fetch();
 	  	$tbases = array();
 	  	while($tbases = $stmt->fetch()){
 	  		$tbases_vector[] = $tbases;
 	  	}
 	  	return array('cancha_array' =>$tbases_vector, 'totalCount'=>$row['totalCount']);
 	  	} catch (Exception $exc) {
 	  		echo $exc->getTraceAsString();
    		Utility::capture($exc);
 	  	}
 	  }
 
    public static function getTotalRows(){
    	$total_rows = 0;
    	try {
    		global $pdo;
    		$sql = 'select count(*) from  cancha';
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
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Cancha');
		$salida_vector = array();
		while ($obj = $stmt->fetch()) {
			$salida_vector[] = $obj;
		}
		return $salida_vector;
    }
}
?>