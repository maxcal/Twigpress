<?php

/**
 * Description of Iterator
 * @todo create class discription
 */



class Twigpress_LoopIterator implements Iterator {
    
    protected $ix = 0;
    
    public function __construct($valid, $current) {
        $this->validClosure = $valid;
        $this->currentClosure = $current;
    }
    public function valid() {
        return call_user_func($this->validClosure);
    }
    public function current() {
        return call_user_func($this->currentClosure);
    }
    public function next() {}
    public function rewind() {}
    public function key() {
        $this->ix = $this->ix + 1;
        return $this->ix;
    }
}