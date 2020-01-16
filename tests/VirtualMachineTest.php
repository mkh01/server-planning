<?php

include_once __DIR__ . './../src/VirtualMachine.php';

class VirtualMachineTest extends PHPUnit_Framework_TestCase
{
    /** @var VirtualMachine */
    private $virtualMachine;

    public function setUp(): void
    {
        parent::setUp();
        $this->virtualMachine = new VirtualMachine();
    }

    public function testGetSetCpu(): void
    {
        $cpu = rand(2, 8);

        $this->virtualMachine->setCpu($cpu);
        $this->assertEquals($cpu, $this->virtualMachine->getCpu());
    }

    public function testGetSetRam(): void
    {
        $ram = rand(2, 32);

        $this->virtualMachine->setRam($ram);
        $this->assertEquals($ram, $this->virtualMachine->getRam());
    }

    public function testGetSetHdd(): void
    {
        $hdd = rand(100, 1000);

        $this->virtualMachine->setHdd($hdd);
        $this->assertEquals($hdd, $this->virtualMachine->getHdd());
    }
}