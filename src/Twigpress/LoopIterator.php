<?php

/**
 * Description of Iterator
 * @todo create class discription
 */
namespace Twigpress;

class LoopIterator implements \Iterator {
    
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
    public function key() {}
}