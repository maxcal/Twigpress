<?php

/**
 * Test bootstrapper
 */

// 


/**
 * Fake wordpress add action
 */

if (!defined("PROJECT_ROOT")) {
    define('PROJECT_ROOT', (dirname(__DIR__)));
    define('MOCKUPS_DIR', (__DIR__.'/mockups/'));
}

require_once  __DIR__.'/stubs/Wp_Query_stub.php';
require_once  __DIR__.'/stubs/Fake_Obj_stub.php';

if (!function_exists( 'add_action' )) {
    function add_action(){
        return false;
    }
}

if (!defined("TEMPLATEPATH")) {
    define('TEMPLATEPATH', dirname(__DIR__) . '/mockups/themes/TwigpresTestTheme');
}

class TP_Query {
    
    public $type;
    
    function __call($method, $arguments){
        $prefix = strtolower(substr($method, 3));
        return ($prefix === $this->type);
    }
}

