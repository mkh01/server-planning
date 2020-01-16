<?php

include_once __DIR__ . './../src/ServerType.php';

class ServerTypeTest extends PHPUnit_Framework_TestCase
{
    /** @var ServerType */
    private $serverType;

    public function setUp(): void
    {
        parent::setUp();
        $this->serverType = new ServerType();
    }

    public function testGetSetCpu(): void
    {
        $cpu = rand(2, 8);

        $this->serverType->setCpu($cpu);
        $this->assertEquals($cpu, $this->serverType->getCpu());
    }

    public function testGetSetRam(): void
    {
        $ram = rand(2, 32);

        $this->serverType->setRam($ram);
        $this->assertEquals($ram, $this->serverType->getRam());
    }

    public function testGetSetHdd(): void
    {
        $hdd = rand(100, 1000);

        $this->serverType->setHdd($hdd);
        $this->assertEquals($hdd, $this->serverType->getHdd());
    }
}
