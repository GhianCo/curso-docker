<?php

class EntityBase {
    
    public function __construct(array $options) {
        foreach ($options as $k => $v) {
            //if (isset($this->$k)) {                
                $this->$k = $v;
            //}
        }
    }
    
    public function getJsonObjectByFields($fields) {
        if (sizeof($fields) != 0) {
            $obj = new stdClass();
            foreach ($fields as $field) {
                $strFunction = "get" . ucfirst($field);
                if (method_exists($this, $strFunction)) {
                    $obj->$field = $this->$strFunction();
                }
            }
            return $obj;
        }else{
            return $this;
        }
    }    
    
}
?>
