<?php

include_once "ProblemInterface.php";

class Day9Part1 implements ProblemInterface
{
    public function expected()
    {
        return 15690279;
    }

    public function solve()
    {
        $numbers = include 'day_09_input.php';
        for ($i = 25; $i < count($numbers); $i++)
        {
            $isSum = false;
            for ($j = $i - 25; $j < $i + 25; $j++) {
                for ($k = $j + 1; $k < $i + 25; $k++) {
                    if ($numbers[$j] + $numbers[$k] == $numbers[$i]) {
                        $isSum = true;
                        break 2;
                    }
                }
            }
            if (!$isSum) {
                return $numbers[$i];
            }
        }
        return -1;
    }
}
