<?php
/*
Plugin Name: Twigpress
Plugin URI: http://www.github.com/maxcal/twigpress/
Description: Use the Twig Engine for your wordpress templates, built on the work of Fabien Potencier and Darko Golešö .
Version: 0.1
Author: Max Calabrese, 
Author URI: http://URI_Of_The_Plugin_Author
License: GPL2
*/

/*  Copyright Max Calabrese 2012

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


class Twigpress{
    
    private $loader;
    private $twig;
    private $template;
    private $globalFunctions = true;
    
    /**
     * Run on class contruction
     * Registers twig outloader and dependencies
     */
    public function __construct() {
        require_once dirname(__FILE__) . '/lib/Twig/Autoloader.php';
        Twig_Autoloader::register();
    }

    /**
     * Run when wordpress is initialized.
     */
    public function init()
    {
        $this->loader = new Twig_Loader_Filesystem( TEMPLATEPATH );
        $this->twig = new Twig_Environment($this->loader, array(
            'cache' => false
        ));
        if ($this->globalFunctions) {
            $this->proxyGlobalFunctions();
        }
    }
    
    public function getTwig(){
        return $this->twig;
    }
    /**
     * Allows twig templates to access all global functions
     * @return void 
     */
    public function proxyGlobalFunctions(){
        $this->twig->registerUndefinedFunctionCallback(function ($name) {
            if (function_exists($name)) {
                return new Twig_Function_Function($name);
            }
            return false;
        });
    }

    /**
     * 
     * @param string $template
     * @param array $arr 
     */
    public function dispatch($template, array $arr = array()) {
        $template_info = pathinfo($template);
        $tmp_root_name = $template_info['dirname'] . DIRECTORY_SEPARATOR . $template_info['filename'];
        
        $arr = array_merge_recursive($arr, array(
            'posts' => $posts
        ));
        
        if (file_exists("$tmp_root_name.html.twig")){
             $this->template = $this->twig->loadTemplate($template_info['filename'].'.html.twig');
        }
        
        $this->template->display($arr);
    }
}


$Twigpress = new Twigpress();
add_action('init', array($Twigpress, 'init'));