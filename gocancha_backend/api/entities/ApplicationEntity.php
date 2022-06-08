<?php 
class ApplicationEntity extends EntityBase implements DBOCrud { 
     function __construct($options = array()) { 
        parent::__construct($options);
    }
    public $application_id; 
    public $application_version; 
    public $application_platform; 
    public $application_canskip; 
    public $application_url; 
    public $application_message; 
    public $application_name; 
    public $application_code; 
    public $application_state; 

    public function getApplication_id(){ 
        return $this->application_id;
    }
    public function setApplication_id($application_id){ 
        $this->application_id = $application_id;
    }
    public function getApplication_version(){ 
        return $this->application_version;
    }
    public function setApplication_version($application_version){ 
        $this->application_version = $application_version;
    }
    public function getApplication_platform(){ 
        return $this->application_platform;
    }
    public function setApplication_platform($application_platform){ 
        $this->application_platform = $application_platform;
    }
    public function getApplication_canskip(){ 
        return $this->application_canskip;
    }
    public function setApplication_canskip($application_canskip){ 
        $this->application_canskip = $application_canskip;
    }
    public function getApplication_url(){ 
        return $this->application_url;
    }
    public function setApplication_url($application_url){ 
        $this->application_url = $application_url;
    }
    public function getApplication_message(){ 
        return $this->application_message;
    }
    public function setApplication_message($application_message){ 
        $this->application_message = $application_message;
    }
    public function getApplication_name(){ 
        return $this->application_name;
    }
    public function setApplication_name($application_name){ 
        $this->application_name = $application_name;
    }
    public function getApplication_code(){ 
        return $this->application_code;
    }
    public function setApplication_code($application_code){ 
        $this->application_code = $application_code;
    }
    public function getApplication_state(){ 
        return $this->application_state;
    }
    public function setApplication_state($application_state){ 
        $this->application_state = $application_state;
    }
 
    public function insert(){
    	try {
    		global $pdo;
    		$query = '';
    		$query2 = '';
    		if(isset($this->application_id))
    			$query.='application_id, ';
    		if(isset($this->application_version))
    			$query.='application_version, ';
    		if(isset($this->application_platform))
    			$query.='application_platform, ';
    		if(isset($this->application_canskip))
    			$query.='application_canskip, ';
    		if(isset($this->application_url))
    			$query.='application_url, ';
    		if(isset($this->application_message))
    			$query.='application_message, ';
    		if(isset($this->application_name))
    			$query.='application_name, ';
    		if(isset($this->application_code))
    			$query.='application_code, ';
    		if(isset($this->application_state))
    			$query.='application_state, ';
    		if(isset($this->application_id))
    			$query2.=':application_id, ';
    		if(isset($this->application_version))
    			$query2.=':application_version, ';
    		if(isset($this->application_platform))
    			$query2.=':application_platform, ';
    		if(isset($this->application_canskip))
    			$query2.=':application_canskip, ';
    		if(isset($this->application_url))
    			$query2.=':application_url, ';
    		if(isset($this->application_message))
    			$query2.=':application_message, ';
    		if(isset($this->application_name))
    			$query2.=':application_name, ';
    		if(isset($this->application_code))
    			$query2.=':application_code, ';
    		if(isset($this->application_state))
    			$query2.=':application_state, ';
    		$query = substr($query, 0, strlen($query) - 2);
    		$query2 = substr($query2, 0, strlen($query2) - 2);

    		$stmt = $pdo->prepare('INSERT INTO application('.$query.') VALUES('.$query2.')');

    		if(isset($this->application_id))
    			$stmt->bindParam(':application_id',	$this->application_id,	PDO::PARAM_STR);
    		if(isset($this->application_version))
    			$stmt->bindParam(':application_version',	$this->application_version,	PDO::PARAM_STR);
    		if(isset($this->application_platform))
    			$stmt->bindParam(':application_platform',	$this->application_platform,	PDO::PARAM_STR);
    		if(isset($this->application_canskip))
    			$stmt->bindParam(':application_canskip',	$this->application_canskip,	PDO::PARAM_STR);
    		if(isset($this->application_url))
    			$stmt->bindParam(':application_url',	$this->application_url,	PDO::PARAM_STR);
    		if(isset($this->application_message))
    			$stmt->bindParam(':application_message',	$this->application_message,	PDO::PARAM_STR);
    		if(isset($this->application_name))
    			$stmt->bindParam(':application_name',	$this->application_name,	PDO::PARAM_STR);
    		if(isset($this->application_code))
    			$stmt->bindParam(':application_code',	$this->application_code,	PDO::PARAM_STR);
    		if(isset($this->application_state))
    			$stmt->bindParam(':application_state',	$this->application_state,	PDO::PARAM_STR);
    		$stmt->execute();
    		if($stmt->rowCount() === 1){
    			$id = $pdo->lastInsertId();
    			$this->application_id = $id;
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
    		$query='UPDATE application SET ';
    		if(isset($this->application_version))
    			$query.='application_version=:application_version, ';
    		if(isset($this->application_platform))
    			$query.='application_platform=:application_platform, ';
    		if(isset($this->application_canskip))
    			$query.='application_canskip=:application_canskip, ';
    		if(isset($this->application_url))
    			$query.='application_url=:application_url, ';
    		if(isset($this->application_message))
    			$query.='application_message=:application_message, ';
    		if(isset($this->application_name))
    			$query.='application_name=:application_name, ';
    		if(isset($this->application_code))
    			$query.='application_code=:application_code, ';
    		if(isset($this->application_state))
    			$query.='application_state=:application_state, ';

    		if($query!='UPDATE application SET ')
    			$query = substr($query, 0, strlen($query) - 2);
    		$query.=' WHERE application_id=:application_id';
    		$stmt = $pdo->prepare($query);

    		$stmt->bindParam(':application_id',	$this->application_id,	PDO::PARAM_STR);

    		if(isset($this->application_version))
    			$stmt->bindParam(':application_version',	$this->application_version,	PDO::PARAM_STR);
    		if(isset($this->application_platform))
    			$stmt->bindParam(':application_platform',	$this->application_platform,	PDO::PARAM_STR);
    		if(isset($this->application_canskip))
    			$stmt->bindParam(':application_canskip',	$this->application_canskip,	PDO::PARAM_STR);
    		if(isset($this->application_url))
    			$stmt->bindParam(':application_url',	$this->application_url,	PDO::PARAM_STR);
    		if(isset($this->application_message))
    			$stmt->bindParam(':application_message',	$this->application_message,	PDO::PARAM_STR);
    		if(isset($this->application_name))
    			$stmt->bindParam(':application_name',	$this->application_name,	PDO::PARAM_STR);
    		if(isset($this->application_code))
    			$stmt->bindParam(':application_code',	$this->application_code,	PDO::PARAM_STR);
    		if(isset($this->application_state))
    			$stmt->bindParam(':application_state',	$this->application_state,	PDO::PARAM_STR);
    		return $stmt->execute();
    	} catch (PDOException $e) {
    		echo 'Error: ' . $e->getMessage();
    		Utility::capture($e);
    	}
    }

 
    public function delete(){
    	try {
    		global $pdo;
    		$sql = 'DELETE FROM application WHERE application_id=:application_id';
    		$stmt = $pdo->prepare($sql);
    		$stmt->bindParam(':application_id',$this->application_id, PDO::PARAM_STR);
    		$stmt->execute();
    		return $stmt->rowCount();
    	} catch (Exception $exc) {
    		echo $exc->getTraceAsString();
    		Utility::capture($exc);
    	}
    }
 
    public static function getById($application_id){
    	global $pdo;
    	$sql = 'SELECT * FROM application WHERE application_id=:application_id';
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':application_id',$application_id, PDO::PARAM_STR);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	if($row){
    		return new Application($row);
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
 	  	$orderClause = ' ORDER by application_id';
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
 	  	$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM application '.$whereClause .' '.$orderClause.' ';
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
 	  	$stmt->setFetchMode(PDO::FETCH_CLASS, 'ApplicationEntity');
 	  	$result = $pdo->query('SELECT FOUND_ROWS() AS totalCount');
 	  	$result->setFetchMode(PDO::FETCH_ASSOC);
 	  	$row = $result->fetch();
 	  	$tbases = array();
 	  	while($tbases = $stmt->fetch()){
 	  		$tbases_vector[] = $tbases;
 	  	}
 	  	return array('application_array' =>$tbases_vector, 'totalCount'=>$row['totalCount']);
 	  	} catch (Exception $exc) {
 	  		echo $exc->getTraceAsString();
    		Utility::capture($exc);
 	  	}
 	  }
 
    public static function getTotalRows(){
    	$total_rows = 0;
    	try {
    		global $pdo;
    		$sql = 'select count(*) from  application';
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