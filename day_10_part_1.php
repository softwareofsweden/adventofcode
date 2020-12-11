<?php

include_once "ProblemInterface.php";

class Day10Part1 implements ProblemInterface
{
    public function expected()
    {
        return 1625;
    }

    public function solve()
    {
        $adapters = include 'day_10_input.php';
        sort($adapters);
        $previous = 0;
        $diff1count = 0;
        $diff3count = 1;
        foreach ($adapters as $adapter) {
            $current = $adapter;
            $diff = $current - $previous;
            $previous = $current;
            $diff1count += $diff == 1 ? 1 : 0;
            $diff3count += $diff == 3 ? 1 : 0;
        }
        return $diff1count * $diff3count;
    }
}
