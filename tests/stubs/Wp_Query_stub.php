<?php

class Wp_Query_stub {
    public $type;
    
    function get_queried_object(){
        return $this->queried_object;
    }


    function __call($method, $arguments){
        $prefix = strtolower(substr($method, 3));
        return ($prefix === $this->type);
    }
}