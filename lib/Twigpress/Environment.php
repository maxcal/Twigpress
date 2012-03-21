<?php



class Twigpress_Environment extends Twig_Environment {
    
    protected $cache = false;

    /**
     * Run on class contruction
     * Registers twig outloader and dependencies
     */
    public function __construct() {
        parent::__construct(new Twig_Loader_Filesystem( array( dirname(__FILE__) )  ), array());
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
}