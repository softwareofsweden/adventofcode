<?php

include_once "ProblemInterface.php";

class Day8Part1 implements ProblemInterface
{
    public function expected()
    {
        return 1859;
    }

    public function solve()
    {
        $program = include 'day_8_input.php';
        return $this->runProgram($program);
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
                return $acc;
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
