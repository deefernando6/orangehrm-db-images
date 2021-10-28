<?php 
class ContainerEnvironmentTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $this->tester->wantTo("Veify the mariaDB version");
        $this->tester->runShellCommand("docker exec db_container ");
    }
}