<?php

include_once "ProblemInterface.php";

class Day15Part2 implements ProblemInterface
{
    public function expected()
    {
        return 950;
    }

    public function solve()
    {
        $startingNumbers = include 'day_15_input.php';
        $spokenNumbers = [];
        $spokenNumbers2 = [];
        for ($i = 0; $i < count($startingNumbers); $i++) {
            $spokenNumbers[$startingNumbers[$i]] = $i;
            $spokenNumbers2[$startingNumbers[$i]] = 0;
        }
        $lastSpoken = $startingNumbers[count($startingNumbers)-1];
        for ($i = count($startingNumbers); $i < 30000000; $i++) {
            $lastSpoken = $spokenNumbers2[$lastSpoken];
            if (!isset($spokenNumbers[$lastSpoken])) {
                $spokenNumbers[$lastSpoken] = $i;
                $spokenNumbers2[$lastSpoken] = 0;
            } else {
                $spokenNumbers2[$lastSpoken] = $i - $spokenNumbers[$lastSpoken];
                $spokenNumbers[$lastSpoken] = $i;
            }
        }
        return $lastSpoken;
    }
}
