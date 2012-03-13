<?php
/*
  @author: Darko Goleš, Max Calabres
  @author URI: http://inchoo.net/author/darko.goles/
*/
class Twigpress_Autoloader {
 
    static public function register() {
        ini_set('unserialize_callback_func', 'spl_autoload_call');
        spl_autoload_register(array(new self, 'autoload'));
    }
    /**
     * @param string $class
     * @return void 
     */
    static public function autoload($class) {
        if (0 !== strpos($class, 'Wp_TwigEngine')) {
            return;
        }
 
        if (file_exists($file = dirname(__FILE__) . '/../' . str_replace(array('_', "\0"), array('/', ''), $class) . '.php')) {
            require $file;
        }
    } 
}