<?php

include_once "ProblemInterface.php";

class Day10Part2 implements ProblemInterface
{
    public function expected()
    {
        return 3100448333024;
    }


    public function solve()
    {
        $adapters = include 'day_10_input.php';
        $adapters[] = 0;
        sort($adapters);
        $adapters[] = max($adapters) + 3;
        $known = [1];
        $adaptersCount = count($adapters);
        $last = 0;
        for ($i = 1; $i < $adaptersCount; $i++) {
            $sum = 0;
            for ($j = 1; $j < 4; $j++) {
                if ($i - $j < 0) {
                    continue;
                }
                if ($adapters[$i] - $adapters[$i - $j] <= 3) {
                    $sum += $known[$i - $j];
                }
            }
            $known[$i] = $sum;
            $last = $sum;
        }
        return $last;
    }
}
