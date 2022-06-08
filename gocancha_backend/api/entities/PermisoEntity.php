<?php 
class PermisoEntity extends EntityBase implements DBOCrud { 
     function __construct($options = array()) { 
        parent::__construct($options);
    }
    public $permiso_id; 
    public $permiso_descripcion; 
    public $permiso_categoria; 
    public $permiso_categoriapadre; 
    public $permiso_modulo; 

    public function getPermiso_id(){ 
        return $this->permiso_id;
    }
    public function setPermiso_id($permiso_id){ 
        $this->permiso_id = $permiso_id;
    }
    public function getPermiso_descripcion(){ 
        return $this->permiso_descripcion;
    }
    public function setPermiso_descripcion($permiso_descripcion){ 
        $this->permiso_descripcion = $permiso_descripcion;
    }
    public function getPermiso_categoria(){ 
        return $this->permiso_categoria;
    }
    public function setPermiso_categoria($permiso_categoria){ 
        $this->permiso_categoria = $permiso_categoria;
    }
    public function getPermiso_categoriapadre(){ 
        return $this->permiso_categoriapadre;
    }
    public function setPermiso_categoriapadre($permiso_categoriapadre){ 
        $this->permiso_categoriapadre = $permiso_categoriapadre;
    }
    public function getPermiso_modulo(){ 
        return $this->permiso_modulo;
    }
    public function setPermiso_modulo($permiso_modulo){ 
        $this->permiso_modulo = $permiso_modulo;
    }
 
    public function insert(){
    	try {
    		global $pdo;
    		$query = '';
    		$query2 = '';
    		if(isset($this->permiso_id))
    			$query.='permiso_id, ';
    		if(isset($this->permiso_descripcion))
    			$query.='permiso_descripcion, ';
    		if(isset($this->permiso_categoria))
    			$query.='permiso_categoria, ';
    		if(isset($this->permiso_categoriapadre))
    			$query.='permiso_categoriapadre, ';
    		if(isset($this->permiso_modulo))
    			$query.='permiso_modulo, ';
    		if(isset($this->permiso_id))
    			$query2.=':permiso_id, ';
    		if(isset($this->permiso_descripcion))
    			$query2.=':permiso_descripcion, ';
    		if(isset($this->permiso_categoria))
    			$query2.=':permiso_categoria, ';
    		if(isset($this->permiso_categoriapadre))
    			$query2.=':permiso_categoriapadre, ';
    		if(isset($this->permiso_modulo))
    			$query2.=':permiso_modulo, ';
    		$query = substr($query, 0, strlen($query) - 2);
    		$query2 = substr($query2, 0, strlen($query2) - 2);

    		$stmt = $pdo->prepare('INSERT INTO permiso('.$query.') VALUES('.$query2.')');

    		if(isset($this->permiso_id))
    			$stmt->bindParam(':permiso_id',	$this->permiso_id,	PDO::PARAM_STR);
    		if(isset($this->permiso_descripcion))
    			$stmt->bindParam(':permiso_descripcion',	$this->permiso_descripcion,	PDO::PARAM_STR);
    		if(isset($this->permiso_categoria))
    			$stmt->bindParam(':permiso_categoria',	$this->permiso_categoria,	PDO::PARAM_STR);
    		if(isset($this->permiso_categoriapadre))
    			$stmt->bindParam(':permiso_categoriapadre',	$this->permiso_categoriapadre,	PDO::PARAM_STR);
    		if(isset($this->permiso_modulo))
    			$stmt->bindParam(':permiso_modulo',	$this->permiso_modulo,	PDO::PARAM_STR);
    		$stmt->execute();
    		if($stmt->rowCount() === 1){
    			$id = $pdo->lastInsertId();
    			$this->permiso_id = $id;
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
    		$query='UPDATE permiso SET ';
    		if(isset($this->permiso_descripcion))
    			$query.='permiso_descripcion=:permiso_descripcion, ';
    		if(isset($this->permiso_categoria))
    			$query.='permiso_categoria=:permiso_categoria, ';
    		if(isset($this->permiso_categoriapadre))
    			$query.='permiso_categoriapadre=:permiso_categoriapadre, ';
    		if(isset($this->permiso_modulo))
    			$query.='permiso_modulo=:permiso_modulo, ';

    		if($query!='UPDATE permiso SET ')
    			$query = substr($query, 0, strlen($query) - 2);
    		$query.=' WHERE permiso_id=:permiso_id';
    		$stmt = $pdo->prepare($query);

    		$stmt->bindParam(':permiso_id',	$this->permiso_id,	PDO::PARAM_STR);

    		if(isset($this->permiso_descripcion))
    			$stmt->bindParam(':permiso_descripcion',	$this->permiso_descripcion,	PDO::PARAM_STR);
    		if(isset($this->permiso_categoria))
    			$stmt->bindParam(':permiso_categoria',	$this->permiso_categoria,	PDO::PARAM_STR);
    		if(isset($this->permiso_categoriapadre))
    			$stmt->bindParam(':permiso_categoriapadre',	$this->permiso_categoriapadre,	PDO::PARAM_STR);
    		if(isset($this->permiso_modulo))
    			$stmt->bindParam(':permiso_modulo',	$this->permiso_modulo,	PDO::PARAM_STR);
    		return $stmt->execute();
    	} catch (PDOException $e) {
    		echo 'Error: ' . $e->getMessage();
    		Utility::capture($e);
    	}
    }

 
    public function delete(){
    	try {
    		global $pdo;
    		$sql = 'DELETE FROM permiso WHERE permiso_id=:permiso_id';
    		$stmt = $pdo->prepare($sql);
    		$stmt->bindParam(':permiso_id',$this->permiso_id, PDO::PARAM_STR);
    		$stmt->execute();
    		return $stmt->rowCount();
    	} catch (Exception $exc) {
    		echo $exc->getTraceAsString();
    		Utility::capture($exc);
    	}
    }
 
    public static function getById($permiso_id){
    	global $pdo;
    	$sql = 'SELECT * FROM permiso WHERE permiso_id=:permiso_id';
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':permiso_id',$permiso_id, PDO::PARAM_STR);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	if($row){
    		return new Permiso($row);
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
 	  	$orderClause = ' ORDER by permiso_id';
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
 	  	$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM permiso '.$whereClause .' '.$orderClause.' ';
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
 	  	$stmt->setFetchMode(PDO::FETCH_CLASS, 'PermisoEntity');
 	  	$result = $pdo->query('SELECT FOUND_ROWS() AS totalCount');
 	  	$result->setFetchMode(PDO::FETCH_ASSOC);
 	  	$row = $result->fetch();
 	  	$tbases = array();
 	  	while($tbases = $stmt->fetch()){
 	  		$tbases_vector[] = $tbases;
 	  	}
 	  	return array('permiso_array' =>$tbases_vector, 'totalCount'=>$row['totalCount']);
 	  	} catch (Exception $exc) {
 	  		echo $exc->getTraceAsString();
    		Utility::capture($exc);
 	  	}
 	  }
 
    public static function getTotalRows(){
    	$total_rows = 0;
    	try {
    		global $pdo;
    		$sql = 'select count(*) from  permiso';
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
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Permiso');
		$salida_vector = array();
		while ($obj = $stmt->fetch()) {
			$salida_vector[] = $obj;
		}
		return $salida_vector;
    }
}
?>