<?php 
class PlatformEntity extends EntityBase implements DBOCrud { 
     function __construct($options = array()) { 
        parent::__construct($options);
    }
    public $platform_id; 
    public $application_id; 
    public $platform_version; 
    public $platform_name; 
    public $platform_canskip; 
    public $platform_url; 
    public $platform_messageupdate; 

    public function getPlatform_id(){ 
        return $this->platform_id;
    }
    public function setPlatform_id($platform_id){ 
        $this->platform_id = $platform_id;
    }
    public function getApplication_id(){ 
        return $this->application_id;
    }
    public function setApplication_id($application_id){ 
        $this->application_id = $application_id;
    }
    public function getPlatform_version(){ 
        return $this->platform_version;
    }
    public function setPlatform_version($platform_version){ 
        $this->platform_version = $platform_version;
    }
    public function getPlatform_name(){ 
        return $this->platform_name;
    }
    public function setPlatform_name($platform_name){ 
        $this->platform_name = $platform_name;
    }
    public function getPlatform_canskip(){ 
        return $this->platform_canskip;
    }
    public function setPlatform_canskip($platform_canskip){ 
        $this->platform_canskip = $platform_canskip;
    }
    public function getPlatform_url(){ 
        return $this->platform_url;
    }
    public function setPlatform_url($platform_url){ 
        $this->platform_url = $platform_url;
    }
    public function getPlatform_messageupdate(){ 
        return $this->platform_messageupdate;
    }
    public function setPlatform_messageupdate($platform_messageupdate){ 
        $this->platform_messageupdate = $platform_messageupdate;
    }
 
    public function insert(){
    	try {
    		global $pdo;
    		$query = '';
    		$query2 = '';
    		if(isset($this->platform_id))
    			$query.='platform_id, ';
    		if(isset($this->application_id))
    			$query.='application_id, ';
    		if(isset($this->platform_version))
    			$query.='platform_version, ';
    		if(isset($this->platform_name))
    			$query.='platform_name, ';
    		if(isset($this->platform_canskip))
    			$query.='platform_canskip, ';
    		if(isset($this->platform_url))
    			$query.='platform_url, ';
    		if(isset($this->platform_messageupdate))
    			$query.='platform_messageupdate, ';
    		if(isset($this->platform_id))
    			$query2.=':platform_id, ';
    		if(isset($this->application_id))
    			$query2.=':application_id, ';
    		if(isset($this->platform_version))
    			$query2.=':platform_version, ';
    		if(isset($this->platform_name))
    			$query2.=':platform_name, ';
    		if(isset($this->platform_canskip))
    			$query2.=':platform_canskip, ';
    		if(isset($this->platform_url))
    			$query2.=':platform_url, ';
    		if(isset($this->platform_messageupdate))
    			$query2.=':platform_messageupdate, ';
    		$query = substr($query, 0, strlen($query) - 2);
    		$query2 = substr($query2, 0, strlen($query2) - 2);

    		$stmt = $pdo->prepare('INSERT INTO platform('.$query.') VALUES('.$query2.')');

    		if(isset($this->platform_id))
    			$stmt->bindParam(':platform_id',	$this->platform_id,	PDO::PARAM_STR);
    		if(isset($this->application_id))
    			$stmt->bindParam(':application_id',	$this->application_id,	PDO::PARAM_STR);
    		if(isset($this->platform_version))
    			$stmt->bindParam(':platform_version',	$this->platform_version,	PDO::PARAM_STR);
    		if(isset($this->platform_name))
    			$stmt->bindParam(':platform_name',	$this->platform_name,	PDO::PARAM_STR);
    		if(isset($this->platform_canskip))
    			$stmt->bindParam(':platform_canskip',	$this->platform_canskip,	PDO::PARAM_STR);
    		if(isset($this->platform_url))
    			$stmt->bindParam(':platform_url',	$this->platform_url,	PDO::PARAM_STR);
    		if(isset($this->platform_messageupdate))
    			$stmt->bindParam(':platform_messageupdate',	$this->platform_messageupdate,	PDO::PARAM_STR);
    		$stmt->execute();
    		if($stmt->rowCount() === 1){
    			$id = $pdo->lastInsertId();
    			$this->platform_id = $id;
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
    		$query='UPDATE platform SET ';
    		if(isset($this->application_id))
    			$query.='application_id=:application_id, ';
    		if(isset($this->platform_version))
    			$query.='platform_version=:platform_version, ';
    		if(isset($this->platform_name))
    			$query.='platform_name=:platform_name, ';
    		if(isset($this->platform_canskip))
    			$query.='platform_canskip=:platform_canskip, ';
    		if(isset($this->platform_url))
    			$query.='platform_url=:platform_url, ';
    		if(isset($this->platform_messageupdate))
    			$query.='platform_messageupdate=:platform_messageupdate, ';

    		if($query!='UPDATE platform SET ')
    			$query = substr($query, 0, strlen($query) - 2);
    		$query.=' WHERE platform_id=:platform_id';
    		$stmt = $pdo->prepare($query);

    		$stmt->bindParam(':platform_id',	$this->platform_id,	PDO::PARAM_STR);

    		if(isset($this->application_id))
    			$stmt->bindParam(':application_id',	$this->application_id,	PDO::PARAM_STR);
    		if(isset($this->platform_version))
    			$stmt->bindParam(':platform_version',	$this->platform_version,	PDO::PARAM_STR);
    		if(isset($this->platform_name))
    			$stmt->bindParam(':platform_name',	$this->platform_name,	PDO::PARAM_STR);
    		if(isset($this->platform_canskip))
    			$stmt->bindParam(':platform_canskip',	$this->platform_canskip,	PDO::PARAM_STR);
    		if(isset($this->platform_url))
    			$stmt->bindParam(':platform_url',	$this->platform_url,	PDO::PARAM_STR);
    		if(isset($this->platform_messageupdate))
    			$stmt->bindParam(':platform_messageupdate',	$this->platform_messageupdate,	PDO::PARAM_STR);
    		return $stmt->execute();
    	} catch (PDOException $e) {
    		echo 'Error: ' . $e->getMessage();
    		Utility::capture($e);
    	}
    }

 
    public function delete(){
    	try {
    		global $pdo;
    		$sql = 'DELETE FROM platform WHERE platform_id=:platform_id';
    		$stmt = $pdo->prepare($sql);
    		$stmt->bindParam(':platform_id',$this->platform_id, PDO::PARAM_STR);
    		$stmt->execute();
    		return $stmt->rowCount();
    	} catch (Exception $exc) {
    		echo $exc->getTraceAsString();
    		Utility::capture($exc);
    	}
    }
 
    public static function getById($platform_id){
    	global $pdo;
    	$sql = 'SELECT * FROM platform WHERE platform_id=:platform_id';
    	$stmt = $pdo->prepare($sql);
    	$stmt->bindParam(':platform_id',$platform_id, PDO::PARAM_STR);
    	$stmt->execute();
    	$row = $stmt->fetch(PDO::FETCH_ASSOC);
    	if($row){
    		return new Platform($row);
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
 	  	$orderClause = ' ORDER by platform_id';
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
 	  	$query = 'SELECT SQL_CALC_FOUND_ROWS * FROM platform '.$whereClause .' '.$orderClause.' ';
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
 	  	$stmt->setFetchMode(PDO::FETCH_CLASS, 'PlatformEntity');
 	  	$result = $pdo->query('SELECT FOUND_ROWS() AS totalCount');
 	  	$result->setFetchMode(PDO::FETCH_ASSOC);
 	  	$row = $result->fetch();
 	  	$tbases = array();
 	  	while($tbases = $stmt->fetch()){
 	  		$tbases_vector[] = $tbases;
 	  	}
 	  	return array('platform_array' =>$tbases_vector, 'totalCount'=>$row['totalCount']);
 	  	} catch (Exception $exc) {
 	  		echo $exc->getTraceAsString();
    		Utility::capture($exc);
 	  	}
 	  }
 
    public static function getTotalRows(){
    	$total_rows = 0;
    	try {
    		global $pdo;
    		$sql = 'select count(*) from  platform';
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