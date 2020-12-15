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
        for ($i = 0; $i < count($startingNumbers); $i++) {
            $spokenNumbers[$startingNumbers[$i]][0] = $i;
        }
        $lastSpoken = $startingNumbers[count($startingNumbers)-1];
        for ($i = count($startingNumbers); $i < 30000000; $i++) {
            $lastSpoken = count($spokenNumbers[$lastSpoken]) == 1 ? 0 : $spokenNumbers[$lastSpoken][0] - $spokenNumbers[$lastSpoken][1];
            if (!isset($spokenNumbers[$lastSpoken])) {
                $spokenNumbers[$lastSpoken][0] = $i;
            } else {
                $spokenNumbers[$lastSpoken] = [
                    $i,
                    $spokenNumbers[$lastSpoken][0]
                ];
            }
        }
        return $lastSpoken;
    }
}
