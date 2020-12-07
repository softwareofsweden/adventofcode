<?php

include_once "ProblemInterface.php";

class Day1Part2 implements ProblemInterface
{
    public function expected()
    {
        return 272611658;
    }

    public function solve()
    {
        //
        // What is the product of the three entries that sum to 2020?
        //
        $input = include 'day_1_input.php';
        sort($input);
        $max = count($input);
        for ($i = 0; $i < $max; $i++) {
            for ($j = $i; $j < $max; $j++) {
                if ($input[$i] + $input[$j] >= 2020) {
                    break;
                }
                for ($k = $j; $k < $max; $k++) {
                    $sum = $input[$i] + $input[$j] + $input[$k];
                    if ($sum > 2020) {
                        break;
                    }
                    if ($sum == 2020) {
                        return $input[$i] * $input[$j] * $input[$k];
                    }
                }
            }
        }
    }
}
