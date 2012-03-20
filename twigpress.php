<?php
/*
Plugin Name: Twigpress
Plugin URI: http://www.github.com/maxcal/twigpress/
Description: Use the Twig Engine for your wordpress templates, built on the work of Fabien Potencier and Darko Golešö .
Version: 0.1
Author: Max Calabrese, 
Author URI: http://github.com/maxcal
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

require_once dirname(__FILE__) . '/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

class Twigpress extends Twig_Environment {
    
    protected $cache = false;

    /**
     * Run on class contruction
     * Registers twig outloader and dependencies
     */
    public function __construct() {
        
        require_once dirname(__FILE__) . '/lib/template_loader.php';
        parent::__construct(new Twig_Loader_Filesystem( array( dirname(__FILE__) )  ), array());
    }
    
    public function appendPath($path){
        $paths = $this->loader->getPaths();
        $paths[] = $path;
        $this->loader->setPaths($paths);
    }

    
}

$Twigpress = new Twigpress();
add_action('init', array($Twigpress, 'init'));