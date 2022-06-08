<?php 
class UsuarioEntity extends EntityBase implements DBOCrud { 
     function __construct($options = array()) { 
        parent::__construct($options);
    }
    public $usuario_id; 
    public $usuario_nombres; 
    public $usuario_apellidos; 
    public $usuario_usuario; 
    public $usuario_clave; 
    public $usuario_estado; 

    public function getUsuario_id(){ 
        return $this->usuario_id;
    }
    public function setUsuario_id($usuario_id){ 
        $this->usuario_id = $usuario_id;
    }
    public function getUsuario_nombres(){ 
        return $this->usuario_nombres;
    }
    public function setUsuario_nombres($usuario_nombres){ 
        $this->usuario_nombres = $usuario_nombres;
    }
    public function getUsuario_apellidos(){ 
        return $this->usuario_apellidos;
    }
    public function setUsuario_apellidos($usuario_apellidos){ 
        $this->usuario_apellidos = $usuario_apellidos;
    }
    public function getUsuario_usuario(){ 
        return $this->usuario_usuario;
    }
    public function setUsuario_usuario($usuario_usuario){ 
        $this->usuario_usuario = $usuario_usuario;
    }
    public function getUsuario_clave(){ 
        return $this->usuario_clave;
    }
    public function setUsuario_clave($usuario_clave){ 
        $this->usuario_clave = $usuario_clave;
    }
    public function getUsuario_estado(){ 
        return $this->usuario_estado;
    }
    public function setUsuario_estado($usuario_estado){ 
        $this->usuario_estado = $usuario_estado;
    }
 
    public function insert(){
    	try {
    		global $pdo;
    		$query = '';
    		$query2 = '';
    		if(isset($this->usuario_id))
    			$query.='usuario_id, ';
    		if(isset($this->usuario_nombres))
    			$query.='usuario_nombres, ';
    		if(isset($this->usuario_apellidos))
    			$query.='usuario_apellidos, ';
    		if(isset($this->usuario_usuario))
    			$query.='usuario_usuario, ';
    		if(isset($this->usuario_clave))
    			$query.='usuario_clave, ';
    		if(isset($this->usuario_estado))
    			$query.='usuario_estado, ';
    		if(isset($this->usuario_id))
    			$query2.=':usuario_id, ';
    		if(isset($this->usuario_nombres))
    			$query2.=':usuario_nombres, ';
    		if(isset($this->usuario_apellidos))
    			$query2.=':usuario_apellidos, ';
    		if(isset($this->usuario_usuario))
    			$query2.=':usuario_usuario, ';
    		if(isset($this->usuario_clave))
    			$query2.=':usuario_clave, ';
    		if(isset($this->usuario_estado))
    			$query2.=':usuario_estado, ';
    		$query = substr($query, 0, strlen($query) - 2);
    		$query2 = substr($query2, 0, strlen($query2) - 2);

    		$stmt = $pdo->prepare('INSERT INTO usuario('.$query.') VALUES('.$query2.')');

    		if(isset($this->usuario_id))
    			$stmt->bindParam(':usuario_id',	$this->usuario_id,	PDO::PARAM_STR);
    		if(isset($this->usuario_nombres))
    			$stmt->bindParam(':usuario_nombres',	$this->usuario_nombres,	PDO::PARAM_STR);
    		if(isset($this->usuario_apellidos))
    			$stmt->bindParam(':usuario_apellidos',	$this->usuario_apellidos,	PDO::PARAM_STR);
    		if(isset($this->usuario_usuario))
    			$stmt->bindParam(':usuario_usuario',	$this->usuario_usuario,	PDO::PARAM_STR);
    		if(isset($this->usuario_clave))
    			$stmt->bindParam(':usuario_clave',	$this->usuario_clave,	PDO::PARAM_STR);
    		if(isset($this->usuario_estado))
    			$stmt->bindParam(':usuario_estado',	$this->usuario_estado,	PDO::PARAM_STR);
    		$stmt->execute();
    		if($stmt->rowCount() === 1){
    			$id = $pdo->lastInsertId();
    			$this->usuario_id = $id;
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
    		$query='UPDATE usuario SET ';
    		if(isset($this->usuario_nombres))
    			$query.='usuario_nombres=:usuario_nombres, ';
    		if(isset($this->usuario_apellidos))
    			$query.='usuario_apellidos=:usuario_apellidos, ';
    		if(isset($this->usuario_usuario))
    			$query.='usuario_usuario=:usuario_usuario, ';
    		if(isset($this->usuario_clave))
    			$query.='usuario_clave=:usuario_clave, ';
    		if(isset($this->usuario_estado))
    			$query.='usuario_estado=:usuario_estado, ';

    		if($query!='UPDATE usuario SET ')
    			$query = substr($query, 0, strlen($query) - 2);
    		$query.=' WHERE usuario_id=:usuario_id';
    		$stmt = $pdo->prepare($query);

    		$stmt->bindParam(':usuario_id',	$this->usuario_id,	PDO::PARAM_STR);

    		if(isset($this->usuario_nombres))
    			$stmt->bindParam(':usuario_nombres',	$this->usuario_nombres,	PDO::PARAM_STR);
    		if(isset($this->usuario_apellidos))
    			$stmt->bindParam(':usuario_apellidos',	$this->usuario_apellidos,	PDO::PARAM_STR);
    		if(isset($this->usuario_usuario))
    			$stmt->bindParam(':usuario_usuario',	$this->usuario_usuario,	PDO::PARAM_STR);
    		if(isset($this->usuario_clave))
    			$stmt->bindParam(':usuario_clave',	$this->usuario_clave,	PDO::PARAM_STR);
    		if(isset($this->usuario_estado))
    			$stmt->bindParam(':usuario_estado',	$this->usuario_estado,	PDO::PARAM_STR);
    		return $stmt->execute();
    	} catch (PDOException $e) {
    		echo 'Error: ' . $e->getMessage();
    		Utility::capture($e);
    	}
    }

 
    public function delete(){
    	try {
    		global $pdo;
    		$sql = 'DELETE FROM usuario WHERE usuario_id=:usuario_id';
    		$stmt = $pdo->prepare($sql);
    		$stmt->bindParam(':usuario_id',$this->usuario_id, PDO::PARAM_STR);
    		$stmt->execute();
    		return $stmt->rowCount();
    	} catch (Exception $exc) {
    		echo $exc->getTraceAsString();
    		Utility::capture($exc);
    	}
    }
 
    public static function getById($usuario_id){
    	global $pdo;
    	$sql = 'SELECT * FROM usuario WHERE usuario_id=:usuario_id';
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':usuario_id',$usuario_id, PDO::PARAM_STR);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	if($row){
    		return new Usuario($row);
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
 	  	$orderClause = ' ORDER by usuario_id';
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
 	  	$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM usuario '.$whereClause .' '.$orderClause.' ';
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
 	  	$stmt->setFetchMode(PDO::FETCH_CLASS, 'UsuarioEntity');
 	  	$result = $pdo->query('SELECT FOUND_ROWS() AS totalCount');
 	  	$result->setFetchMode(PDO::FETCH_ASSOC);
 	  	$row = $result->fetch();
 	  	$tbases = array();
 	  	while($tbases = $stmt->fetch()){
 	  		$tbases_vector[] = $tbases;
 	  	}
 	  	return array('usuario_array' =>$tbases_vector, 'totalCount'=>$row['totalCount']);
 	  	} catch (Exception $exc) {
 	  		echo $exc->getTraceAsString();
    		Utility::capture($exc);
 	  	}
 	  }
 
    public static function getTotalRows(){
    	$total_rows = 0;
    	try {
    		global $pdo;
    		$sql = 'select count(*) from  usuario';
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
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
		$salida_vector = array();
		while ($obj = $stmt->fetch()) {
			$salida_vector[] = $obj;
		}
		return $salida_vector;
    }
}
?>