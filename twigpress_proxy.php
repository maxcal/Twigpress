<?php

/**
 * @name        twigpress_proxy
 * @package     twigpress_plugin
 */

/**
 * Proxy Class used to call wordpress functions from the Twig engine. 
 */
class Twigpress_Proxy {

    /**
     * Call a function or raise a E_USER_ERROR if function does not exist.
     * @param string $function
     * @param array $arguments
     * @return mixed 
     */
    public function __call($function, $arguments) {
 
        if (!function_exists($function)) {
            trigger_error('call to unexisting function ' . $function, E_USER_ERROR);
            return NULL;
        }
        return call_user_func_array($function, $arguments);
    }
}