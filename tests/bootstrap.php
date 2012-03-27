<?php

/**
 * Define Globals
 */
if (!defined("PROJECT_ROOT")) {
    define('PROJECT_ROOT', (dirname(__DIR__)));
    define('MOCKUPS_DIR', (__DIR__.'/mockups/'));
}

require_once  PROJECT_ROOT.'/twigpress.php';
require_once  PROJECT_ROOT.'/tests/stubs/Fake_Obj_stub.php';
require_once  PROJECT_ROOT.'/tests/stubs/Wp_Query_stub.php';

/**
 * Fake wordpress add_action
 */
if (!function_exists( 'add_action' )) {
    function add_action(){
        return false;
    }
}

/**
 * Fake wordpress TEMPLATEPATH
 */
if (!defined("TEMPLATEPATH")) {
    define('TEMPLATEPATH', dirname(__DIR__) . '/mockups/themes/TwigpresTestTheme');
}

