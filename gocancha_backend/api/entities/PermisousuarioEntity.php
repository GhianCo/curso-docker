<?php 
class PermisousuarioEntity extends EntityBase implements DBOCrud { 
     function __construct($options = array()) { 
        parent::__construct($options);
    }
    public $permisousuario_id; 
    public $permiso_id; 
    public $usuario_id; 
    public $permisousuario_estado; 

    public function getPermisousuario_id(){ 
        return $this->permisousuario_id;
    }
    public function setPermisousuario_id($permisousuario_id){ 
        $this->permisousuario_id = $permisousuario_id;
    }
    public function getPermiso_id(){ 
        return $this->permiso_id;
    }
    public function setPermiso_id($permiso_id){ 
        $this->permiso_id = $permiso_id;
    }
    public function getUsuario_id(){ 
        return $this->usuario_id;
    }
    public function setUsuario_id($usuario_id){ 
        $this->usuario_id = $usuario_id;
    }
    public function getPermisousuario_estado(){ 
        return $this->permisousuario_estado;
    }
    public function setPermisousuario_estado($permisousuario_estado){ 
        $this->permisousuario_estado = $permisousuario_estado;
    }
 
    public function insert(){
    	try {
    		global $pdo;
    		$query = '';
    		$query2 = '';
    		if(isset($this->permisousuario_id))
    			$query.='permisousuario_id, ';
    		if(isset($this->permiso_id))
    			$query.='permiso_id, ';
    		if(isset($this->usuario_id))
    			$query.='usuario_id, ';
    		if(isset($this->permisousuario_estado))
    			$query.='permisousuario_estado, ';
    		if(isset($this->permisousuario_id))
    			$query2.=':permisousuario_id, ';
    		if(isset($this->permiso_id))
    			$query2.=':permiso_id, ';
    		if(isset($this->usuario_id))
    			$query2.=':usuario_id, ';
    		if(isset($this->permisousuario_estado))
    			$query2.=':permisousuario_estado, ';
    		$query = substr($query, 0, strlen($query) - 2);
    		$query2 = substr($query2, 0, strlen($query2) - 2);

    		$stmt = $pdo->prepare('INSERT INTO permisousuario('.$query.') VALUES('.$query2.')');

    		if(isset($this->permisousuario_id))
    			$stmt->bindParam(':permisousuario_id',	$this->permisousuario_id,	PDO::PARAM_STR);
    		if(isset($this->permiso_id))
    			$stmt->bindParam(':permiso_id',	$this->permiso_id,	PDO::PARAM_STR);
    		if(isset($this->usuario_id))
    			$stmt->bindParam(':usuario_id',	$this->usuario_id,	PDO::PARAM_STR);
    		if(isset($this->permisousuario_estado))
    			$stmt->bindParam(':permisousuario_estado',	$this->permisousuario_estado,	PDO::PARAM_STR);
    		$stmt->execute();
    		if($stmt->rowCount() === 1){
    			$id = $pdo->lastInsertId();
    			$this->permisousuario_id = $id;
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
    		$query='UPDATE permisousuario SET ';
    		if(isset($this->permiso_id))
    			$query.='permiso_id=:permiso_id, ';
    		if(isset($this->usuario_id))
    			$query.='usuario_id=:usuario_id, ';
    		if(isset($this->permisousuario_estado))
    			$query.='permisousuario_estado=:permisousuario_estado, ';

    		if($query!='UPDATE permisousuario SET ')
    			$query = substr($query, 0, strlen($query) - 2);
    		$query.=' WHERE permisousuario_id=:permisousuario_id';
    		$stmt = $pdo->prepare($query);

    		$stmt->bindParam(':permisousuario_id',	$this->permisousuario_id,	PDO::PARAM_STR);

    		if(isset($this->permiso_id))
    			$stmt->bindParam(':permiso_id',	$this->permiso_id,	PDO::PARAM_STR);
    		if(isset($this->usuario_id))
    			$stmt->bindParam(':usuario_id',	$this->usuario_id,	PDO::PARAM_STR);
    		if(isset($this->permisousuario_estado))
    			$stmt->bindParam(':permisousuario_estado',	$this->permisousuario_estado,	PDO::PARAM_STR);
    		return $stmt->execute();
    	} catch (PDOException $e) {
    		echo 'Error: ' . $e->getMessage();
    		Utility::capture($e);
    	}
    }

 
    public function delete(){
    	try {
    		global $pdo;
    		$sql = 'DELETE FROM permisousuario WHERE permisousuario_id=:permisousuario_id';
    		$stmt = $pdo->prepare($sql);
    		$stmt->bindParam(':permisousuario_id',$this->permisousuario_id, PDO::PARAM_STR);
    		$stmt->execute();
    		return $stmt->rowCount();
    	} catch (Exception $exc) {
    		echo $exc->getTraceAsString();
    		Utility::capture($exc);
    	}
    }
 
    public static function getById($permisousuario_id){
    	global $pdo;
    	$sql = 'SELECT * FROM permisousuario WHERE permisousuario_id=:permisousuario_id';
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':permisousuario_id',$permisousuario_id, PDO::PARAM_STR);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	if($row){
    		return new Permisousuario($row);
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
 	  	$orderClause = ' ORDER by permisousuario_id';
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
 	  	$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM permisousuario '.$whereClause .' '.$orderClause.' ';
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
 	  	$stmt->setFetchMode(PDO::FETCH_CLASS, 'PermisousuarioEntity');
 	  	$result = $pdo->query('SELECT FOUND_ROWS() AS totalCount');
 	  	$result->setFetchMode(PDO::FETCH_ASSOC);
 	  	$row = $result->fetch();
 	  	$tbases = array();
 	  	while($tbases = $stmt->fetch()){
 	  		$tbases_vector[] = $tbases;
 	  	}
 	  	return array('permisousuario_array' =>$tbases_vector, 'totalCount'=>$row['totalCount']);
 	  	} catch (Exception $exc) {
 	  		echo $exc->getTraceAsString();
    		Utility::capture($exc);
 	  	}
 	  }
 
    public static function getTotalRows(){
    	$total_rows = 0;
    	try {
    		global $pdo;
    		$sql = 'select count(*) from  permisousuario';
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
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Permisousuario');
		$salida_vector = array();
		while ($obj = $stmt->fetch()) {
			$salida_vector[] = $obj;
		}
		return $salida_vector;
    }
}
?>