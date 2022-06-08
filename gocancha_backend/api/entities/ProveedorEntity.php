<?php 
class ProveedorEntity extends EntityBase implements DBOCrud { 
     function __construct($options = array()) { 
        parent::__construct($options);
    }
    public $proveedor_id; 
    public $proveedor_nombre; 
    public $proveedor_razonsocial; 
    public $proveedor_ruc; 
    public $proveedor_fecharegistro; 
    public $proveedor_latitud; 
    public $proveedor_longitud; 
    public $proveedor_direccion; 
    public $proveedor_referencia; 
    public $proveedor_urllogo; 
    public $proveedor_rating; 
    public $proveedor_tipocomision; 
    public $proveedor_comision; 
    public $proveedor_porcetanjereserva; 
    public $proveedor_contacto; 
    public $proveedor_telefono; 
    public $proveedor_encendido; 
    public $proveedor_estado; 

    public function getProveedor_id(){ 
        return $this->proveedor_id;
    }
    public function setProveedor_id($proveedor_id){ 
        $this->proveedor_id = $proveedor_id;
    }
    public function getProveedor_nombre(){ 
        return $this->proveedor_nombre;
    }
    public function setProveedor_nombre($proveedor_nombre){ 
        $this->proveedor_nombre = $proveedor_nombre;
    }
    public function getProveedor_razonsocial(){ 
        return $this->proveedor_razonsocial;
    }
    public function setProveedor_razonsocial($proveedor_razonsocial){ 
        $this->proveedor_razonsocial = $proveedor_razonsocial;
    }
    public function getProveedor_ruc(){ 
        return $this->proveedor_ruc;
    }
    public function setProveedor_ruc($proveedor_ruc){ 
        $this->proveedor_ruc = $proveedor_ruc;
    }
    public function getProveedor_fecharegistro(){ 
        return $this->proveedor_fecharegistro;
    }
    public function setProveedor_fecharegistro($proveedor_fecharegistro){ 
        $this->proveedor_fecharegistro = $proveedor_fecharegistro;
    }
    public function getProveedor_latitud(){ 
        return $this->proveedor_latitud;
    }
    public function setProveedor_latitud($proveedor_latitud){ 
        $this->proveedor_latitud = $proveedor_latitud;
    }
    public function getProveedor_longitud(){ 
        return $this->proveedor_longitud;
    }
    public function setProveedor_longitud($proveedor_longitud){ 
        $this->proveedor_longitud = $proveedor_longitud;
    }
    public function getProveedor_direccion(){ 
        return $this->proveedor_direccion;
    }
    public function setProveedor_direccion($proveedor_direccion){ 
        $this->proveedor_direccion = $proveedor_direccion;
    }
    public function getProveedor_referencia(){ 
        return $this->proveedor_referencia;
    }
    public function setProveedor_referencia($proveedor_referencia){ 
        $this->proveedor_referencia = $proveedor_referencia;
    }
    public function getProveedor_urllogo(){ 
        return $this->proveedor_urllogo;
    }
    public function setProveedor_urllogo($proveedor_urllogo){ 
        $this->proveedor_urllogo = $proveedor_urllogo;
    }
    public function getProveedor_rating(){ 
        return $this->proveedor_rating;
    }
    public function setProveedor_rating($proveedor_rating){ 
        $this->proveedor_rating = $proveedor_rating;
    }
    public function getProveedor_tipocomision(){ 
        return $this->proveedor_tipocomision;
    }
    public function setProveedor_tipocomision($proveedor_tipocomision){ 
        $this->proveedor_tipocomision = $proveedor_tipocomision;
    }
    public function getProveedor_comision(){ 
        return $this->proveedor_comision;
    }
    public function setProveedor_comision($proveedor_comision){ 
        $this->proveedor_comision = $proveedor_comision;
    }
    public function getProveedor_porcetanjereserva(){ 
        return $this->proveedor_porcetanjereserva;
    }
    public function setProveedor_porcetanjereserva($proveedor_porcetanjereserva){ 
        $this->proveedor_porcetanjereserva = $proveedor_porcetanjereserva;
    }
    public function getProveedor_contacto(){ 
        return $this->proveedor_contacto;
    }
    public function setProveedor_contacto($proveedor_contacto){ 
        $this->proveedor_contacto = $proveedor_contacto;
    }
    public function getProveedor_telefono(){ 
        return $this->proveedor_telefono;
    }
    public function setProveedor_telefono($proveedor_telefono){ 
        $this->proveedor_telefono = $proveedor_telefono;
    }
    public function getProveedor_encendido(){ 
        return $this->proveedor_encendido;
    }
    public function setProveedor_encendido($proveedor_encendido){ 
        $this->proveedor_encendido = $proveedor_encendido;
    }
    public function getProveedor_estado(){ 
        return $this->proveedor_estado;
    }
    public function setProveedor_estado($proveedor_estado){ 
        $this->proveedor_estado = $proveedor_estado;
    }
 
    public function insert(){
    	try {
    		global $pdo;
    		$query = '';
    		$query2 = '';
    		if(isset($this->proveedor_id))
    			$query.='proveedor_id, ';
    		if(isset($this->proveedor_nombre))
    			$query.='proveedor_nombre, ';
    		if(isset($this->proveedor_razonsocial))
    			$query.='proveedor_razonsocial, ';
    		if(isset($this->proveedor_ruc))
    			$query.='proveedor_ruc, ';
    		if(isset($this->proveedor_fecharegistro))
    			$query.='proveedor_fecharegistro, ';
    		if(isset($this->proveedor_latitud))
    			$query.='proveedor_latitud, ';
    		if(isset($this->proveedor_longitud))
    			$query.='proveedor_longitud, ';
    		if(isset($this->proveedor_direccion))
    			$query.='proveedor_direccion, ';
    		if(isset($this->proveedor_referencia))
    			$query.='proveedor_referencia, ';
    		if(isset($this->proveedor_urllogo))
    			$query.='proveedor_urllogo, ';
    		if(isset($this->proveedor_rating))
    			$query.='proveedor_rating, ';
    		if(isset($this->proveedor_tipocomision))
    			$query.='proveedor_tipocomision, ';
    		if(isset($this->proveedor_comision))
    			$query.='proveedor_comision, ';
    		if(isset($this->proveedor_porcetanjereserva))
    			$query.='proveedor_porcetanjereserva, ';
    		if(isset($this->proveedor_contacto))
    			$query.='proveedor_contacto, ';
    		if(isset($this->proveedor_telefono))
    			$query.='proveedor_telefono, ';
    		if(isset($this->proveedor_encendido))
    			$query.='proveedor_encendido, ';
    		if(isset($this->proveedor_estado))
    			$query.='proveedor_estado, ';
    		if(isset($this->proveedor_id))
    			$query2.=':proveedor_id, ';
    		if(isset($this->proveedor_nombre))
    			$query2.=':proveedor_nombre, ';
    		if(isset($this->proveedor_razonsocial))
    			$query2.=':proveedor_razonsocial, ';
    		if(isset($this->proveedor_ruc))
    			$query2.=':proveedor_ruc, ';
    		if(isset($this->proveedor_fecharegistro))
    			$query2.=':proveedor_fecharegistro, ';
    		if(isset($this->proveedor_latitud))
    			$query2.=':proveedor_latitud, ';
    		if(isset($this->proveedor_longitud))
    			$query2.=':proveedor_longitud, ';
    		if(isset($this->proveedor_direccion))
    			$query2.=':proveedor_direccion, ';
    		if(isset($this->proveedor_referencia))
    			$query2.=':proveedor_referencia, ';
    		if(isset($this->proveedor_urllogo))
    			$query2.=':proveedor_urllogo, ';
    		if(isset($this->proveedor_rating))
    			$query2.=':proveedor_rating, ';
    		if(isset($this->proveedor_tipocomision))
    			$query2.=':proveedor_tipocomision, ';
    		if(isset($this->proveedor_comision))
    			$query2.=':proveedor_comision, ';
    		if(isset($this->proveedor_porcetanjereserva))
    			$query2.=':proveedor_porcetanjereserva, ';
    		if(isset($this->proveedor_contacto))
    			$query2.=':proveedor_contacto, ';
    		if(isset($this->proveedor_telefono))
    			$query2.=':proveedor_telefono, ';
    		if(isset($this->proveedor_encendido))
    			$query2.=':proveedor_encendido, ';
    		if(isset($this->proveedor_estado))
    			$query2.=':proveedor_estado, ';
    		$query = substr($query, 0, strlen($query) - 2);
    		$query2 = substr($query2, 0, strlen($query2) - 2);

    		$stmt = $pdo->prepare('INSERT INTO proveedor('.$query.') VALUES('.$query2.')');

    		if(isset($this->proveedor_id))
    			$stmt->bindParam(':proveedor_id',	$this->proveedor_id,	PDO::PARAM_STR);
    		if(isset($this->proveedor_nombre))
    			$stmt->bindParam(':proveedor_nombre',	$this->proveedor_nombre,	PDO::PARAM_STR);
    		if(isset($this->proveedor_razonsocial))
    			$stmt->bindParam(':proveedor_razonsocial',	$this->proveedor_razonsocial,	PDO::PARAM_STR);
    		if(isset($this->proveedor_ruc))
    			$stmt->bindParam(':proveedor_ruc',	$this->proveedor_ruc,	PDO::PARAM_STR);
    		if(isset($this->proveedor_fecharegistro))
    			$stmt->bindParam(':proveedor_fecharegistro',	$this->proveedor_fecharegistro,	PDO::PARAM_STR);
    		if(isset($this->proveedor_latitud))
    			$stmt->bindParam(':proveedor_latitud',	$this->proveedor_latitud,	PDO::PARAM_STR);
    		if(isset($this->proveedor_longitud))
    			$stmt->bindParam(':proveedor_longitud',	$this->proveedor_longitud,	PDO::PARAM_STR);
    		if(isset($this->proveedor_direccion))
    			$stmt->bindParam(':proveedor_direccion',	$this->proveedor_direccion,	PDO::PARAM_STR);
    		if(isset($this->proveedor_referencia))
    			$stmt->bindParam(':proveedor_referencia',	$this->proveedor_referencia,	PDO::PARAM_STR);
    		if(isset($this->proveedor_urllogo))
    			$stmt->bindParam(':proveedor_urllogo',	$this->proveedor_urllogo,	PDO::PARAM_STR);
    		if(isset($this->proveedor_rating))
    			$stmt->bindParam(':proveedor_rating',	$this->proveedor_rating,	PDO::PARAM_STR);
    		if(isset($this->proveedor_tipocomision))
    			$stmt->bindParam(':proveedor_tipocomision',	$this->proveedor_tipocomision,	PDO::PARAM_STR);
    		if(isset($this->proveedor_comision))
    			$stmt->bindParam(':proveedor_comision',	$this->proveedor_comision,	PDO::PARAM_STR);
    		if(isset($this->proveedor_porcetanjereserva))
    			$stmt->bindParam(':proveedor_porcetanjereserva',	$this->proveedor_porcetanjereserva,	PDO::PARAM_STR);
    		if(isset($this->proveedor_contacto))
    			$stmt->bindParam(':proveedor_contacto',	$this->proveedor_contacto,	PDO::PARAM_STR);
    		if(isset($this->proveedor_telefono))
    			$stmt->bindParam(':proveedor_telefono',	$this->proveedor_telefono,	PDO::PARAM_STR);
    		if(isset($this->proveedor_encendido))
    			$stmt->bindParam(':proveedor_encendido',	$this->proveedor_encendido,	PDO::PARAM_STR);
    		if(isset($this->proveedor_estado))
    			$stmt->bindParam(':proveedor_estado',	$this->proveedor_estado,	PDO::PARAM_STR);
    		$stmt->execute();
    		if($stmt->rowCount() === 1){
    			$id = $pdo->lastInsertId();
    			$this->proveedor_id = $id;
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
    		$query='UPDATE proveedor SET ';
    		if(isset($this->proveedor_nombre))
    			$query.='proveedor_nombre=:proveedor_nombre, ';
    		if(isset($this->proveedor_razonsocial))
    			$query.='proveedor_razonsocial=:proveedor_razonsocial, ';
    		if(isset($this->proveedor_ruc))
    			$query.='proveedor_ruc=:proveedor_ruc, ';
    		if(isset($this->proveedor_fecharegistro))
    			$query.='proveedor_fecharegistro=:proveedor_fecharegistro, ';
    		if(isset($this->proveedor_latitud))
    			$query.='proveedor_latitud=:proveedor_latitud, ';
    		if(isset($this->proveedor_longitud))
    			$query.='proveedor_longitud=:proveedor_longitud, ';
    		if(isset($this->proveedor_direccion))
    			$query.='proveedor_direccion=:proveedor_direccion, ';
    		if(isset($this->proveedor_referencia))
    			$query.='proveedor_referencia=:proveedor_referencia, ';
    		if(isset($this->proveedor_urllogo))
    			$query.='proveedor_urllogo=:proveedor_urllogo, ';
    		if(isset($this->proveedor_rating))
    			$query.='proveedor_rating=:proveedor_rating, ';
    		if(isset($this->proveedor_tipocomision))
    			$query.='proveedor_tipocomision=:proveedor_tipocomision, ';
    		if(isset($this->proveedor_comision))
    			$query.='proveedor_comision=:proveedor_comision, ';
    		if(isset($this->proveedor_porcetanjereserva))
    			$query.='proveedor_porcetanjereserva=:proveedor_porcetanjereserva, ';
    		if(isset($this->proveedor_contacto))
    			$query.='proveedor_contacto=:proveedor_contacto, ';
    		if(isset($this->proveedor_telefono))
    			$query.='proveedor_telefono=:proveedor_telefono, ';
    		if(isset($this->proveedor_encendido))
    			$query.='proveedor_encendido=:proveedor_encendido, ';
    		if(isset($this->proveedor_estado))
    			$query.='proveedor_estado=:proveedor_estado, ';

    		if($query!='UPDATE proveedor SET ')
    			$query = substr($query, 0, strlen($query) - 2);
    		$query.=' WHERE proveedor_id=:proveedor_id';
    		$stmt = $pdo->prepare($query);

    		$stmt->bindParam(':proveedor_id',	$this->proveedor_id,	PDO::PARAM_STR);

    		if(isset($this->proveedor_nombre))
    			$stmt->bindParam(':proveedor_nombre',	$this->proveedor_nombre,	PDO::PARAM_STR);
    		if(isset($this->proveedor_razonsocial))
    			$stmt->bindParam(':proveedor_razonsocial',	$this->proveedor_razonsocial,	PDO::PARAM_STR);
    		if(isset($this->proveedor_ruc))
    			$stmt->bindParam(':proveedor_ruc',	$this->proveedor_ruc,	PDO::PARAM_STR);
    		if(isset($this->proveedor_fecharegistro))
    			$stmt->bindParam(':proveedor_fecharegistro',	$this->proveedor_fecharegistro,	PDO::PARAM_STR);
    		if(isset($this->proveedor_latitud))
    			$stmt->bindParam(':proveedor_latitud',	$this->proveedor_latitud,	PDO::PARAM_STR);
    		if(isset($this->proveedor_longitud))
    			$stmt->bindParam(':proveedor_longitud',	$this->proveedor_longitud,	PDO::PARAM_STR);
    		if(isset($this->proveedor_direccion))
    			$stmt->bindParam(':proveedor_direccion',	$this->proveedor_direccion,	PDO::PARAM_STR);
    		if(isset($this->proveedor_referencia))
    			$stmt->bindParam(':proveedor_referencia',	$this->proveedor_referencia,	PDO::PARAM_STR);
    		if(isset($this->proveedor_urllogo))
    			$stmt->bindParam(':proveedor_urllogo',	$this->proveedor_urllogo,	PDO::PARAM_STR);
    		if(isset($this->proveedor_rating))
    			$stmt->bindParam(':proveedor_rating',	$this->proveedor_rating,	PDO::PARAM_STR);
    		if(isset($this->proveedor_tipocomision))
    			$stmt->bindParam(':proveedor_tipocomision',	$this->proveedor_tipocomision,	PDO::PARAM_STR);
    		if(isset($this->proveedor_comision))
    			$stmt->bindParam(':proveedor_comision',	$this->proveedor_comision,	PDO::PARAM_STR);
    		if(isset($this->proveedor_porcetanjereserva))
    			$stmt->bindParam(':proveedor_porcetanjereserva',	$this->proveedor_porcetanjereserva,	PDO::PARAM_STR);
    		if(isset($this->proveedor_contacto))
    			$stmt->bindParam(':proveedor_contacto',	$this->proveedor_contacto,	PDO::PARAM_STR);
    		if(isset($this->proveedor_telefono))
    			$stmt->bindParam(':proveedor_telefono',	$this->proveedor_telefono,	PDO::PARAM_STR);
    		if(isset($this->proveedor_encendido))
    			$stmt->bindParam(':proveedor_encendido',	$this->proveedor_encendido,	PDO::PARAM_STR);
    		if(isset($this->proveedor_estado))
    			$stmt->bindParam(':proveedor_estado',	$this->proveedor_estado,	PDO::PARAM_STR);
    		return $stmt->execute();
    	} catch (PDOException $e) {
    		echo 'Error: ' . $e->getMessage();
    		Utility::capture($e);
    	}
    }

 
    public function delete(){
    	try {
    		global $pdo;
    		$sql = 'DELETE FROM proveedor WHERE proveedor_id=:proveedor_id';
    		$stmt = $pdo->prepare($sql);
    		$stmt->bindParam(':proveedor_id',$this->proveedor_id, PDO::PARAM_STR);
    		$stmt->execute();
    		return $stmt->rowCount();
    	} catch (Exception $exc) {
    		echo $exc->getTraceAsString();
    		Utility::capture($exc);
    	}
    }
 
    public static function getById($proveedor_id){
    	global $pdo;
    	$sql = 'SELECT * FROM proveedor WHERE proveedor_id=:proveedor_id';
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':proveedor_id',$proveedor_id, PDO::PARAM_STR);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	if($row){
    		return new Proveedor($row);
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
 	  	$orderClause = ' ORDER by proveedor_id';
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
 	  	$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM proveedor '.$whereClause .' '.$orderClause.' ';
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
 	  	$stmt->setFetchMode(PDO::FETCH_CLASS, 'ProveedorEntity');
 	  	$result = $pdo->query('SELECT FOUND_ROWS() AS totalCount');
 	  	$result->setFetchMode(PDO::FETCH_ASSOC);
 	  	$row = $result->fetch();
 	  	$tbases = array();
 	  	while($tbases = $stmt->fetch()){
 	  		$tbases_vector[] = $tbases;
 	  	}
 	  	return array('proveedor_array' =>$tbases_vector, 'totalCount'=>$row['totalCount']);
 	  	} catch (Exception $exc) {
 	  		echo $exc->getTraceAsString();
    		Utility::capture($exc);
 	  	}
 	  }
 
    public static function getTotalRows(){
    	$total_rows = 0;
    	try {
    		global $pdo;
    		$sql = 'select count(*) from  proveedor';
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
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Proveedor');
		$salida_vector = array();
		while ($obj = $stmt->fetch()) {
			$salida_vector[] = $obj;
		}
		return $salida_vector;
    }
}
?>