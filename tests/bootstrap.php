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

if (!function_exists( 'add_action' )) {
    function add_action(){
        return false;
    }
}

if (!defined("TEMPLATEPATH")) {
    define('TEMPLATEPATH', dirname(__DIR__) . '/mockups/themes/TwigpresTestTheme');
}