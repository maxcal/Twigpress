<?php

class Wp_Query_stub {
    public $type;
    
    function __call($method, $arguments){
        $prefix = strtolower(substr($method, 3));
        return ($prefix === $this->type);
    }
}