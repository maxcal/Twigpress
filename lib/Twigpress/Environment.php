<?php



class Twigpress_Environment extends Twig_Environment {
    
    protected $cache = false;
    
    /**
     * Run on class contruction
     * Registers twig outloader and dependencies
     */
    public function __construct() {
        parent::__construct(new Twig_Loader_Filesystem( array()  ), array());
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
    
    public function autoRender($wp_query){
        $template_loader = new Twigpress_TemplateLoader($this->loader->getPaths());
        $tmp = $template_loader->get_template($wp_query);
        
        if (!$tmp){
            if (function_exists('wp_die')){
                wp_die('Twigpress_TemplateLoader::autoRender failed to load any templates');
            }
            return false;
        }
        else {
             $template = $this->loadTemplate($tmp);
             return $template->render(array());
        }
        
    }
    
    public function autoDisplay($wp_query){
        echo $this->autoRender($wp_query);
    }




    public function init(){
        
    }
}