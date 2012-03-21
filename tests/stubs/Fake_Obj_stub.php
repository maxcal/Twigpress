<?php

class Fake_Obj_stub {
    function __get($property) {
        return (property_exists($this, $property)) ? $this->$property : null;
    }
}
