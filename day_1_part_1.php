<?php

include_once "ProblemInterface.php";

class Day1Part1 implements ProblemInterface
{
    public function expected()
    {
        return 468051;
    }

    public function solve()
    {
        //
        // Find the two entries that sum to 2020 and then multiply those two numbers together
        //
        $input = include 'day_1_input.php';
        $max = count($input);
        for ($i = 0; $i < $max; $i++) {
            for ($j = $i; $j < $max; $j++) {
                if ($input[$i] + $input[$j] == 2020) {
                    return $input[$i] * $input[$j];
                }
            }
        }
    }
}

