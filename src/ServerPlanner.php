<?php

/**
 * @param ServerType $server
 * @param array $virtualMachines
 * @return int
 * @throws Exception
 */
function calculate(ServerType $server, array $virtualMachines): int
{
    //get Cpu, Ram and Hdd type from the provided ServerType
    $serverTypeCpu = $server->getCpu();
    $serverTypeRam = $server->getRam();
    $serverTypeHdd = $server->getHdd();

    $result = 0;

    //make new Empty Server Type
    $server = [
        'cpu' => 0,
        'ram' => 0,
        'hdd' => 0,
    ];

    if (count($virtualMachines) == 0) {
        throw new Exception("Given virtual Machines Array is empty");
    } else {
        foreach ($virtualMachines as $virtualMachine) {
            //get Cpu, Ram and Hdd capacity from the provided virtual Machine
            $vMachineCpu = $virtualMachine->getCpu();
            $vMachineRam = $virtualMachine->getRam();
            $vMachineHdd = $virtualMachine->getHdd();

            //Skip a virtual machine if it is bigger than the provided Server Type
            if (
                $vMachineCpu <= $serverTypeCpu
                && $vMachineRam <= $serverTypeRam
                && $vMachineHdd <= $serverTypeHdd
            ) {
                //check if we need a new Server
                $newServerNeeded = newServerNeeded($server['cpu'], $server['ram'], $server['hdd'], $vMachineCpu, $vMachineRam, $vMachineHdd);

                if ($newServerNeeded) {
                    //assign the new Server with the given Server type Capacity and increase result with 1
                    $server['cpu'] = $serverTypeCpu;
                    $server['ram'] = $serverTypeRam;
                    $server['hdd'] = $serverTypeHdd;
                    $result++;
                }
                //allocate the virtual machine on the current Server
                $server['cpu'] -= $vMachineCpu;
                $server['ram'] -= $vMachineRam;
                $server['hdd'] -= $vMachineHdd;
            }
        }
    }
    return $result;
}

/**
 * @param $newServerCpu
 * @param $newServerRam
 * @param $newServerHdd
 * @param $vMachineCpu
 * @param $vMachineRam
 * @param $vMachineHdd
 * @return bool
 */
function newServerNeeded($newServerCpu, $newServerRam, $newServerHdd, $vMachineCpu, $vMachineRam, $vMachineHdd): bool
{
    $result = false;

    //check prerequisites for new Server
    if (
        $newServerCpu === 0
        || $newServerRam === 0
        || $newServerHdd === 0
        || $newServerCpu < $vMachineCpu
        || $newServerRam < $vMachineRam
        || $newServerHdd < $vMachineHdd
    ) {
        $result = true;
    }
    return $result;
}
