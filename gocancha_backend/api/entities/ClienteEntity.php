<?php 
class ClienteEntity extends EntityBase implements DBOCrud { 
     function __construct($options = array()) { 
        parent::__construct($options);
    }
    public $cliente_id; 
    public $cliente_nombres; 
    public $cliente_apellidos; 
    public $cliente_telefono; 
    public $cliente_fecharegistro; 
    public $cliente_activado; 
    public $cliente_codigoactivo; 
    public $cliente_fbid; 
    public $cliente_gid; 
    public $cliente_aid; 
    public $cliente_estado; 
    public $cliente_urlfoto; 
    public $cliente_correo; 
    public $cliente_tipocomprobante; 
    public $cliente_numerodoc; 
    public $cliente_razonsocial; 
    public $cliente_direccion; 

    public function getCliente_id(){ 
        return $this->cliente_id;
    }
    public function setCliente_id($cliente_id){ 
        $this->cliente_id = $cliente_id;
    }
    public function getCliente_nombres(){ 
        return $this->cliente_nombres;
    }
    public function setCliente_nombres($cliente_nombres){ 
        $this->cliente_nombres = $cliente_nombres;
    }
    public function getCliente_apellidos(){ 
        return $this->cliente_apellidos;
    }
    public function setCliente_apellidos($cliente_apellidos){ 
        $this->cliente_apellidos = $cliente_apellidos;
    }
    public function getCliente_telefono(){ 
        return $this->cliente_telefono;
    }
    public function setCliente_telefono($cliente_telefono){ 
        $this->cliente_telefono = $cliente_telefono;
    }
    public function getCliente_fecharegistro(){ 
        return $this->cliente_fecharegistro;
    }
    public function setCliente_fecharegistro($cliente_fecharegistro){ 
        $this->cliente_fecharegistro = $cliente_fecharegistro;
    }
    public function getCliente_activado(){ 
        return $this->cliente_activado;
    }
    public function setCliente_activado($cliente_activado){ 
        $this->cliente_activado = $cliente_activado;
    }
    public function getCliente_codigoactivo(){ 
        return $this->cliente_codigoactivo;
    }
    public function setCliente_codigoactivo($cliente_codigoactivo){ 
        $this->cliente_codigoactivo = $cliente_codigoactivo;
    }
    public function getCliente_fbid(){ 
        return $this->cliente_fbid;
    }
    public function setCliente_fbid($cliente_fbid){ 
        $this->cliente_fbid = $cliente_fbid;
    }
    public function getCliente_gid(){ 
        return $this->cliente_gid;
    }
    public function setCliente_gid($cliente_gid){ 
        $this->cliente_gid = $cliente_gid;
    }
    public function getCliente_aid(){ 
        return $this->cliente_aid;
    }
    public function setCliente_aid($cliente_aid){ 
        $this->cliente_aid = $cliente_aid;
    }
    public function getCliente_estado(){ 
        return $this->cliente_estado;
    }
    public function setCliente_estado($cliente_estado){ 
        $this->cliente_estado = $cliente_estado;
    }
    public function getCliente_urlfoto(){ 
        return $this->cliente_urlfoto;
    }
    public function setCliente_urlfoto($cliente_urlfoto){ 
        $this->cliente_urlfoto = $cliente_urlfoto;
    }
    public function getCliente_correo(){ 
        return $this->cliente_correo;
    }
    public function setCliente_correo($cliente_correo){ 
        $this->cliente_correo = $cliente_correo;
    }
    public function getCliente_tipocomprobante(){ 
        return $this->cliente_tipocomprobante;
    }
    public function setCliente_tipocomprobante($cliente_tipocomprobante){ 
        $this->cliente_tipocomprobante = $cliente_tipocomprobante;
    }
    public function getCliente_numerodoc(){ 
        return $this->cliente_numerodoc;
    }
    public function setCliente_numerodoc($cliente_numerodoc){ 
        $this->cliente_numerodoc = $cliente_numerodoc;
    }
    public function getCliente_razonsocial(){ 
        return $this->cliente_razonsocial;
    }
    public function setCliente_razonsocial($cliente_razonsocial){ 
        $this->cliente_razonsocial = $cliente_razonsocial;
    }
    public function getCliente_direccion(){ 
        return $this->cliente_direccion;
    }
    public function setCliente_direccion($cliente_direccion){ 
        $this->cliente_direccion = $cliente_direccion;
    }
 
    public function insert(){
    	try {
    		global $pdo;
    		$query = '';
    		$query2 = '';
    		if(isset($this->cliente_id))
    			$query.='cliente_id, ';
    		if(isset($this->cliente_nombres))
    			$query.='cliente_nombres, ';
    		if(isset($this->cliente_apellidos))
    			$query.='cliente_apellidos, ';
    		if(isset($this->cliente_telefono))
    			$query.='cliente_telefono, ';
    		if(isset($this->cliente_fecharegistro))
    			$query.='cliente_fecharegistro, ';
    		if(isset($this->cliente_activado))
    			$query.='cliente_activado, ';
    		if(isset($this->cliente_codigoactivo))
    			$query.='cliente_codigoactivo, ';
    		if(isset($this->cliente_fbid))
    			$query.='cliente_fbid, ';
    		if(isset($this->cliente_gid))
    			$query.='cliente_gid, ';
    		if(isset($this->cliente_aid))
    			$query.='cliente_aid, ';
    		if(isset($this->cliente_estado))
    			$query.='cliente_estado, ';
    		if(isset($this->cliente_urlfoto))
    			$query.='cliente_urlfoto, ';
    		if(isset($this->cliente_correo))
    			$query.='cliente_correo, ';
    		if(isset($this->cliente_tipocomprobante))
    			$query.='cliente_tipocomprobante, ';
    		if(isset($this->cliente_numerodoc))
    			$query.='cliente_numerodoc, ';
    		if(isset($this->cliente_razonsocial))
    			$query.='cliente_razonsocial, ';
    		if(isset($this->cliente_direccion))
    			$query.='cliente_direccion, ';
    		if(isset($this->cliente_id))
    			$query2.=':cliente_id, ';
    		if(isset($this->cliente_nombres))
    			$query2.=':cliente_nombres, ';
    		if(isset($this->cliente_apellidos))
    			$query2.=':cliente_apellidos, ';
    		if(isset($this->cliente_telefono))
    			$query2.=':cliente_telefono, ';
    		if(isset($this->cliente_fecharegistro))
    			$query2.=':cliente_fecharegistro, ';
    		if(isset($this->cliente_activado))
    			$query2.=':cliente_activado, ';
    		if(isset($this->cliente_codigoactivo))
    			$query2.=':cliente_codigoactivo, ';
    		if(isset($this->cliente_fbid))
    			$query2.=':cliente_fbid, ';
    		if(isset($this->cliente_gid))
    			$query2.=':cliente_gid, ';
    		if(isset($this->cliente_aid))
    			$query2.=':cliente_aid, ';
    		if(isset($this->cliente_estado))
    			$query2.=':cliente_estado, ';
    		if(isset($this->cliente_urlfoto))
    			$query2.=':cliente_urlfoto, ';
    		if(isset($this->cliente_correo))
    			$query2.=':cliente_correo, ';
    		if(isset($this->cliente_tipocomprobante))
    			$query2.=':cliente_tipocomprobante, ';
    		if(isset($this->cliente_numerodoc))
    			$query2.=':cliente_numerodoc, ';
    		if(isset($this->cliente_razonsocial))
    			$query2.=':cliente_razonsocial, ';
    		if(isset($this->cliente_direccion))
    			$query2.=':cliente_direccion, ';
    		$query = substr($query, 0, strlen($query) - 2);
    		$query2 = substr($query2, 0, strlen($query2) - 2);

    		$stmt = $pdo->prepare('INSERT INTO cliente('.$query.') VALUES('.$query2.')');

    		if(isset($this->cliente_id))
    			$stmt->bindParam(':cliente_id',	$this->cliente_id,	PDO::PARAM_STR);
    		if(isset($this->cliente_nombres))
    			$stmt->bindParam(':cliente_nombres',	$this->cliente_nombres,	PDO::PARAM_STR);
    		if(isset($this->cliente_apellidos))
    			$stmt->bindParam(':cliente_apellidos',	$this->cliente_apellidos,	PDO::PARAM_STR);
    		if(isset($this->cliente_telefono))
    			$stmt->bindParam(':cliente_telefono',	$this->cliente_telefono,	PDO::PARAM_STR);
    		if(isset($this->cliente_fecharegistro))
    			$stmt->bindParam(':cliente_fecharegistro',	$this->cliente_fecharegistro,	PDO::PARAM_STR);
    		if(isset($this->cliente_activado))
    			$stmt->bindParam(':cliente_activado',	$this->cliente_activado,	PDO::PARAM_STR);
    		if(isset($this->cliente_codigoactivo))
    			$stmt->bindParam(':cliente_codigoactivo',	$this->cliente_codigoactivo,	PDO::PARAM_STR);
    		if(isset($this->cliente_fbid))
    			$stmt->bindParam(':cliente_fbid',	$this->cliente_fbid,	PDO::PARAM_STR);
    		if(isset($this->cliente_gid))
    			$stmt->bindParam(':cliente_gid',	$this->cliente_gid,	PDO::PARAM_STR);
    		if(isset($this->cliente_aid))
    			$stmt->bindParam(':cliente_aid',	$this->cliente_aid,	PDO::PARAM_STR);
    		if(isset($this->cliente_estado))
    			$stmt->bindParam(':cliente_estado',	$this->cliente_estado,	PDO::PARAM_STR);
    		if(isset($this->cliente_urlfoto))
    			$stmt->bindParam(':cliente_urlfoto',	$this->cliente_urlfoto,	PDO::PARAM_STR);
    		if(isset($this->cliente_correo))
    			$stmt->bindParam(':cliente_correo',	$this->cliente_correo,	PDO::PARAM_STR);
    		if(isset($this->cliente_tipocomprobante))
    			$stmt->bindParam(':cliente_tipocomprobante',	$this->cliente_tipocomprobante,	PDO::PARAM_STR);
    		if(isset($this->cliente_numerodoc))
    			$stmt->bindParam(':cliente_numerodoc',	$this->cliente_numerodoc,	PDO::PARAM_STR);
    		if(isset($this->cliente_razonsocial))
    			$stmt->bindParam(':cliente_razonsocial',	$this->cliente_razonsocial,	PDO::PARAM_STR);
    		if(isset($this->cliente_direccion))
    			$stmt->bindParam(':cliente_direccion',	$this->cliente_direccion,	PDO::PARAM_STR);
    		$stmt->execute();
    		if($stmt->rowCount() === 1){
    			$id = $pdo->lastInsertId();
    			$this->cliente_id = $id;
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
    		$query='UPDATE cliente SET ';
    		if(isset($this->cliente_nombres))
    			$query.='cliente_nombres=:cliente_nombres, ';
    		if(isset($this->cliente_apellidos))
    			$query.='cliente_apellidos=:cliente_apellidos, ';
    		if(isset($this->cliente_telefono))
    			$query.='cliente_telefono=:cliente_telefono, ';
    		if(isset($this->cliente_fecharegistro))
    			$query.='cliente_fecharegistro=:cliente_fecharegistro, ';
    		if(isset($this->cliente_activado))
    			$query.='cliente_activado=:cliente_activado, ';
    		if(isset($this->cliente_codigoactivo))
    			$query.='cliente_codigoactivo=:cliente_codigoactivo, ';
    		if(isset($this->cliente_fbid))
    			$query.='cliente_fbid=:cliente_fbid, ';
    		if(isset($this->cliente_gid))
    			$query.='cliente_gid=:cliente_gid, ';
    		if(isset($this->cliente_aid))
    			$query.='cliente_aid=:cliente_aid, ';
    		if(isset($this->cliente_estado))
    			$query.='cliente_estado=:cliente_estado, ';
    		if(isset($this->cliente_urlfoto))
    			$query.='cliente_urlfoto=:cliente_urlfoto, ';
    		if(isset($this->cliente_correo))
    			$query.='cliente_correo=:cliente_correo, ';
    		if(isset($this->cliente_tipocomprobante))
    			$query.='cliente_tipocomprobante=:cliente_tipocomprobante, ';
    		if(isset($this->cliente_numerodoc))
    			$query.='cliente_numerodoc=:cliente_numerodoc, ';
    		if(isset($this->cliente_razonsocial))
    			$query.='cliente_razonsocial=:cliente_razonsocial, ';
    		if(isset($this->cliente_direccion))
    			$query.='cliente_direccion=:cliente_direccion, ';

    		if($query!='UPDATE cliente SET ')
    			$query = substr($query, 0, strlen($query) - 2);
    		$query.=' WHERE cliente_id=:cliente_id';
    		$stmt = $pdo->prepare($query);

    		$stmt->bindParam(':cliente_id',	$this->cliente_id,	PDO::PARAM_STR);

    		if(isset($this->cliente_nombres))
    			$stmt->bindParam(':cliente_nombres',	$this->cliente_nombres,	PDO::PARAM_STR);
    		if(isset($this->cliente_apellidos))
    			$stmt->bindParam(':cliente_apellidos',	$this->cliente_apellidos,	PDO::PARAM_STR);
    		if(isset($this->cliente_telefono))
    			$stmt->bindParam(':cliente_telefono',	$this->cliente_telefono,	PDO::PARAM_STR);
    		if(isset($this->cliente_fecharegistro))
    			$stmt->bindParam(':cliente_fecharegistro',	$this->cliente_fecharegistro,	PDO::PARAM_STR);
    		if(isset($this->cliente_activado))
    			$stmt->bindParam(':cliente_activado',	$this->cliente_activado,	PDO::PARAM_STR);
    		if(isset($this->cliente_codigoactivo))
    			$stmt->bindParam(':cliente_codigoactivo',	$this->cliente_codigoactivo,	PDO::PARAM_STR);
    		if(isset($this->cliente_fbid))
    			$stmt->bindParam(':cliente_fbid',	$this->cliente_fbid,	PDO::PARAM_STR);
    		if(isset($this->cliente_gid))
    			$stmt->bindParam(':cliente_gid',	$this->cliente_gid,	PDO::PARAM_STR);
    		if(isset($this->cliente_aid))
    			$stmt->bindParam(':cliente_aid',	$this->cliente_aid,	PDO::PARAM_STR);
    		if(isset($this->cliente_estado))
    			$stmt->bindParam(':cliente_estado',	$this->cliente_estado,	PDO::PARAM_STR);
    		if(isset($this->cliente_urlfoto))
    			$stmt->bindParam(':cliente_urlfoto',	$this->cliente_urlfoto,	PDO::PARAM_STR);
    		if(isset($this->cliente_correo))
    			$stmt->bindParam(':cliente_correo',	$this->cliente_correo,	PDO::PARAM_STR);
    		if(isset($this->cliente_tipocomprobante))
    			$stmt->bindParam(':cliente_tipocomprobante',	$this->cliente_tipocomprobante,	PDO::PARAM_STR);
    		if(isset($this->cliente_numerodoc))
    			$stmt->bindParam(':cliente_numerodoc',	$this->cliente_numerodoc,	PDO::PARAM_STR);
    		if(isset($this->cliente_razonsocial))
    			$stmt->bindParam(':cliente_razonsocial',	$this->cliente_razonsocial,	PDO::PARAM_STR);
    		if(isset($this->cliente_direccion))
    			$stmt->bindParam(':cliente_direccion',	$this->cliente_direccion,	PDO::PARAM_STR);
    		return $stmt->execute();
    	} catch (PDOException $e) {
    		echo 'Error: ' . $e->getMessage();
    		Utility::capture($e);
    	}
    }

 
    public function delete(){
    	try {
    		global $pdo;
    		$sql = 'DELETE FROM cliente WHERE cliente_id=:cliente_id';
    		$stmt = $pdo->prepare($sql);
    		$stmt->bindParam(':cliente_id',$this->cliente_id, PDO::PARAM_STR);
    		$stmt->execute();
    		return $stmt->rowCount();
    	} catch (Exception $exc) {
    		echo $exc->getTraceAsString();
    		Utility::capture($exc);
    	}
    }
 
    public static function getById($cliente_id){
    	global $pdo;
    	$sql = 'SELECT * FROM cliente WHERE cliente_id=:cliente_id';
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':cliente_id',$cliente_id, PDO::PARAM_STR);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	if($row){
    		return new Cliente($row);
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
 	  	$orderClause = ' ORDER by cliente_id';
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
 	  	$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM cliente '.$whereClause .' '.$orderClause.' ';
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
 	  	$stmt->setFetchMode(PDO::FETCH_CLASS, 'ClienteEntity');
 	  	$result = $pdo->query('SELECT FOUND_ROWS() AS totalCount');
 	  	$result->setFetchMode(PDO::FETCH_ASSOC);
 	  	$row = $result->fetch();
 	  	$tbases = array();
 	  	while($tbases = $stmt->fetch()){
 	  		$tbases_vector[] = $tbases;
 	  	}
 	  	return array('cliente_array' =>$tbases_vector, 'totalCount'=>$row['totalCount']);
 	  	} catch (Exception $exc) {
 	  		echo $exc->getTraceAsString();
    		Utility::capture($exc);
 	  	}
 	  }
 
    public static function getTotalRows(){
    	$total_rows = 0;
    	try {
    		global $pdo;
    		$sql = 'select count(*) from  cliente';
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
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Cliente');
		$salida_vector = array();
		while ($obj = $stmt->fetch()) {
			$salida_vector[] = $obj;
		}
		return $salida_vector;
    }
}
?>