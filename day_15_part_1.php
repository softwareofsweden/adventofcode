<?php

include_once "ProblemInterface.php";

class Day15Part1 implements ProblemInterface
{
    public function expected()
    {
        return 260;
    }

    public function solve()
    {
        $startingNumbers = include 'day_15_input.php';
        $spokenNumbers = [];
        for ($i = 0; $i < count($startingNumbers); $i++) {
            $spokenNumbers[$startingNumbers[$i]][0] = $i;
        }
        $lastSpoken = $startingNumbers[count($startingNumbers)-1];
        for ($i = count($startingNumbers); $i < 2020; $i++) {
            $lastSpoken = count($spokenNumbers[$lastSpoken]) == 1 ? 0 : max($spokenNumbers[$lastSpoken]) - min($spokenNumbers[$lastSpoken]);
            if (!array_key_exists($lastSpoken, $spokenNumbers)) {
                $spokenNumbers[$lastSpoken][0] = $i;
            } else {
                $spokenNumbers[$lastSpoken] = [
                    max($spokenNumbers[$lastSpoken]),
                    $i
                ];
            }
        }
        return $lastSpoken;
    }
}
