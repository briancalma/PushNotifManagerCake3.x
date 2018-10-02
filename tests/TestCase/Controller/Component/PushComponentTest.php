<?php
namespace PushManager\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;
use PushManager\Controller\Component\PushComponent;

/**
 * PushManager\Controller\Component\PushComponent Test Case
 */
class PushComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \PushManager\Controller\Component\PushComponent
     */
    public $Push;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Push = new PushComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Push);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
