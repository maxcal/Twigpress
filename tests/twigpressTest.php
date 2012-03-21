<?php
/**
 * Test class for foo.
 * Generated by PHPUnit on 2012-03-20 at 21:24:59.
 */
class twigpressTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Twigpress
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
       $this->object = new Twigpress_Environment();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers Twigpress::__construct
     */
    public function testConstruct() {
        // Assert that twigpress will look for missing templates
        $paths = $this->object->getLoader()->getPaths();
        $this->assertEquals($paths[0], PROJECT_ROOT.'/lib/Twigpress');
    }
  
      
    /**
     * @covers Twigpress::__addPath
     */
    public function testAppendPath() {
        
        $this->object->appendPath(MOCKUPS_DIR);
        $paths = $this->object->getLoader()->getPaths();
        $this->assertContains(MOCKUPS_DIR, $paths);
        $this->assertEquals($paths[count($paths)-1], MOCKUPS_DIR);
    }
    
    /**
     * @covers Twigpress::__addPath
     */
    public function testPrependPath() {
        $this->object->prependPath(MOCKUPS_DIR);
        $paths = $this->object->getLoader()->getPaths();
        $this->assertContains(MOCKUPS_DIR, $paths);
        $this->assertEquals($paths[0], MOCKUPS_DIR);
    }

    public function testDisplay(){
        $this->object->prependPath(MOCKUPS_DIR.'/twig');
        $template = $this->object->loadTemplate('helloworld.test.twig');
        $this->assertContains('Hello World!', $template->render(array()));
    }

    public function testRegisterGlobalFunctions(){
        $this->object->prependPath(MOCKUPS_DIR.'/twig');
        $this->object->registerGlobalFunctions();
                
        $template = $this->object->loadTemplate('php_implode.test.twig');

        $this->assertEquals('abc', $template->render(array()));
    }
}

?>
