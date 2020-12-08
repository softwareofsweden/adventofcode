<?php

include_once "ProblemInterface.php";

class Day8Part2 implements ProblemInterface
{
    public function expected()
    {
        return 1235;
    }

    public function solve()
    {
        $program = include 'day_8_input.php';
        foreach (['nop', 'jmp'] as $newOpcode) {
            for ($i = 0; $i < count($program); $i++) {
                $opcode = substr($program[$i], 0, strpos($program[$i], ' '));
                $arg = substr($program[$i], strpos($program[$i], ' ') + 1);
                if ($opcode != 'acc' && $opcode != $newOpcode) {
                    $modifiedProgram = $program;
                    $modifiedProgram[$i] = $newOpcode . ' ' . $arg;
                    $returnValue = $this->runProgram($modifiedProgram);
                    if ($returnValue !== false) {
                        return $returnValue;
                    }
                }
            }
        }
        return false;
    }

    protected function runProgram($program)
    {
        $pc = 0;
        $acc = 0;
        $trace = [];
        while (true) {
            $opcode = substr($program[$pc], 0, strpos($program[$pc], ' '));
            $arg = substr($program[$pc], strpos($program[$pc], ' ') + 1);
            if (in_array($pc, $trace)) {
                return false;
            }
            $trace[] = $pc;
            switch ($opcode) {
                case "nop":
                    $pc++;
                    break;
                case "jmp":
                    $pc = $pc + intval($arg);
                    break;
                case "acc":
                    $acc = $acc + intval($arg);
                    $pc++;
                    break;
            }
            if ($pc >= count($program)) {
                break;
            }
        }
        return $acc;
    }
}
