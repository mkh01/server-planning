<?php

include_once __DIR__ . './../src/ServerPlanner.php';

class ServerPlannerTest extends PHPUnit_Framework_TestCase
{
    public function testCalculate()
    {
        $server = new ServerType();
        $server->setCpu(2);
        $server->setRam(32);
        $server->setHdd(100);

        $vMachine1 = new VirtualMachine();
        $vMachine1->setCpu(1);
        $vMachine1->setRam(16);
        $vMachine1->setHdd(10);

        $vMachine2 = new VirtualMachine();
        $vMachine2->setCpu(1);
        $vMachine2->setRam(16);
        $vMachine2->setHdd(10);

        $vMachine3 = new VirtualMachine();
        $vMachine3->setCpu(2);
        $vMachine3->setRam(32);
        $vMachine3->setHdd(100);

        $vMachine4 = new VirtualMachine();
        $vMachine4->setCpu(4);
        $vMachine4->setRam(32);
        $vMachine4->setHdd(100);

        $vMachines = [
            $vMachine1,
            $vMachine2,
            $vMachine3,
            $vMachine4
        ];

        //test with all virtual machines
        $result = calculate($server, $vMachines);
        $this->assertEquals($result, 2);

        //test exception with providing an empty array to calculate function
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Given virtual Machines Array is empty');
        calculate($server, []);

        //test with a virtual machine bigger than our Server Type
        $result = calculate($server, [$vMachine4]);
        $this->assertEquals($result, 0);

        //test with a two different virtual machines
        $result = calculate($server, [$vMachine1, $vMachine3]);
        $this->assertEquals($result, 0);
    }
}
