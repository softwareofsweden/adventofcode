<?php

include_once "ProblemInterface.php";

class Day1Part1 implements ProblemInterface
{
    public function solve()
    {
        //
        // Find the two entries that sum to 2020 and then multiply those two numbers together
        //
        $input = include 'day_1_input.php';
        for ($i = 0; $i < count($input); $i++) {
            for ($j = 0; $j < count($input); $j++) {
                if ($input[$i] + $input[$j] == 2020) {
                    return $input[$i] * $input[$j];
                }
            }
        }
    }
}

