<?php

namespace Twigpress;

use Twig_Environment;
use Twig_Loader_Filesystem;
use Twig_Function_Function;


class Environment extends Twig_Environment {
    
    protected $cache = false;
    
    /**
     * Run on class contruction
     * Registers twig outloader and dependencies
     */
    public function __construct() {
        parent::__construct(new Twig_Loader_Filesystem( array()  ), array());
    }

    
    /**
     * Render a template
     * @param string $tmp
     * @return string 
     */
    public function render($tmp){

        $template = $this->loadTemplate($tmp);
        return $template->render($view_data);

    }

        
    
    /**
     * Append a path to the Loader paths.
     * 
     * @param string $path 
     */
    public function appendPath($path){
        $paths = $this->loader->getPaths();
        $paths[] = $path;
        $this->loader->setPaths($paths);
    }

    /**
     *
     * @param string $path 
     */
    public function prependPath($path){
        $paths = $this->loader->getPaths();
        array_unshift ( $paths, $path );
        $this->loader->setPaths($paths);
        
    }
    
    public function registerGlobalFunctions(){
        $this->registerUndefinedFunctionCallback(function ($name) {
            if (function_exists($name)) {
                return new Twig_Function_Function($name);
            }
            return false;
        });
    }
    
    public function autoRender($wp_query, array $view_data = array()){
        $template_loader = new TemplateLoader($this->loader->getPaths());
        $tmp = $template_loader->get_template($wp_query);
        
        if (!$tmp){
            if (function_exists('wp_die')){
                wp_die('Twigpress_TemplateLoader::autoRender failed to load any templates');
            }
            return false;
        }
        else {
             $template = $this->loadTemplate($tmp);
             return $template->render($view_data);
        }
        
    }
    
    public function autoDisplay($wp_query, array $view_data = array()){
        echo $this->autoRender($wp_query, $view_data);
    }
}