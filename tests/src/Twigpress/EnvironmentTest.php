<?php

use Twigpress\Environment;
/**
 * Generated by PHPUnit_SkeletonGenerator on 2012-06-21 at 13:17:48.
 */

class Wp_Query_stub {
    public $type;
    
    function get_queried_object(){
        return $this->queried_object;
    }

    
    
    
    function __call($method, $arguments){
        $prefix = strtolower(substr($method, 3));
        return ($prefix === $this->type);
    }
}

class EnvironmentTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Twigpress\Environment
     */
    protected $environment;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->environment = new Environment;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Environment::appendPath
     */
    public function testAppendPath()
    {
        
        $this->environment->appendPath(__DIR__);
        $this->environment->appendPath(__DIR__.'/../');
        
        $loader = $this->environment->getLoader();
        
        // Remove the following lines when you implement this test.
        $this->assertEquals(array(__DIR__, __DIR__.'/../'), $loader->getPaths(), 
                'Assert that path is added to the end of the loaders paths');
    }

    /**
     * @covers Environment::prependPath
     */
    public function testPrependPath()
    {
        // Remove the following lines when you implement this test.
        $this->environment->appendPath(__DIR__.'/../');
        $this->environment->prependPath(__DIR__);
        
        $loader = $this->environment->getLoader();
        $this->assertEquals(array(__DIR__, __DIR__.'/../'), $loader->getPaths(),
                'Assert that path is added to the beginning of the loaders paths');
    }

    /**
     * @covers Environment::registerGlobalFunctions
     * @todo   Implement testRegisterGlobalFunctions().
     */
    public function testRegisterGlobalFunctions()
    {
        $this->environment->prependPath(__DIR__ .'/templates');
        $this->environment->registerGlobalFunctions();
        $template = $this->environment->loadTemplate('implode.twig');

        $arr = array('a','b', 'c');
        
        
        $this->assertEquals(implode(',',$arr), $template->render(array('arr' => $arr)),
                'Assert that global functions may be used in template');
    }

    /**
     * @covers Environment::autoRender
     * @covers Environment::autoDisplay
     */
    public function testAutoRender()
    {
        $this->environment->prependPath(__DIR__.'/templates');
        $loader = $this->environment->getLoader();
        
        //$template = $this->environment->autoRender(new Wp_Query_stub());
    }

    /**
     * 
     * @todo   Implement testAutoDisplay().
     */
    public function testAutoDisplay()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }
    
    /**
     * @covers Environment::init
     * @todo   Implement testInit().
     */
    public function testInit()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }
}


