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
    
    private $twig;
    private $template;
    private $cache = false;
    private $globalFunctions = true;
    private $globalVariables = true;


    /**
     * Run on class contruction
     * Registers twig outloader and dependencies
     */
    public function __construct() {
        require_once dirname(__FILE__) . '/lib/Twig/Autoloader.php';
        require_once dirname(__FILE__) . '/template_loader.php';
        Twig_Autoloader::register();
    }

    /**
     * Run when wordpress is initialized.
     */
    public function init()
    {
        $this->twig = new Twig_Environment(
                new Twig_Loader_Filesystem( TEMPLATEPATH ), 
                array(
                    'cache' => $this->cache
                ));
        if ($this->globalFunctions) {
            $this->proxyGlobalFunctions();
        }
        if ($this->globalVariables) {
            $this->proxyGlobalVariables();
        }
    }
    
    public function getTwig(){
        return $this->twig;
    }
    /**
     * Allows twig templates to access all global functions
     * @return void 
     */
    public function proxyGlobalFunctions()
    {
        $this->twig->registerUndefinedFunctionCallback(function ($name) {
            if (function_exists($name)) {
                return new Twig_Function_Function($name);
            }
            return false;
        });
    }
    /**
     * Gives twig templates access to wordpress global variables
     * @return void
     */
    public function proxyGlobalVariables(){
        global $posts, $post, $wp_did_header, $wp_did_template_redirect, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;
        $wp_globals = array(
            'posts' => $posts,
            'post'  => $post,
            'wp_did_header' => $wp_did_header,
            'wp_did_template_redirect' => $wp_did_template_redirect,
            'wp_query' => $wp_query,
            'wp_rewrite' => $wp_rewrite,
            'wpdb' => $wpdb,
            'wp_version' => $wp_version,
            'wp'    => $wp,
            'id'    => $id,
            'comment' => $comment,
            'user_ID' => $user_ID
        );
        
        foreach ($wp_globals as $name => $value){
            $this->twig->addGlobal($name, $value);
        }   
    }

    /**
     * Auto-Magic convenience function 
     * loads a twig file according to Wordpress template inheritance rules.
     * 
     * @param array $arr an array of params to send to the view.
     */
    public function autoDisplay(array $arr = array()) 
    {
        global $posts;
         
        $arr = array_merge_recursive($arr, array(
            'posts' => $posts,
        ));
        
        $loader = new Twigpress_Template_Loader();
        
        $this->template = $this->twig->loadTemplate(
                $loader->get_template());
        
        $this->template->display($arr);
    }
}

$Twigpress = new Twigpress();
add_action('init', array($Twigpress, 'init'));