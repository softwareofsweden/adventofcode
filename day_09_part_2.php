<?php

include_once "ProblemInterface.php";

class Day9Part2 implements ProblemInterface
{
    public function expected()
    {
        return 2174232;
    }

    public function solve()
    {
        $numbers = include 'day_09_input.php';
        $numberToFind = 15690279;
        for ($offset = 0; $offset < count($numbers); $offset++)
        {
            $maxLength = count($numbers) - $offset;
            for ($length = 2; $maxLength; $length++) {
                $slice = array_slice($numbers, $offset, $length);
                $sum = array_sum($slice);
                if ($sum == $numberToFind) {
                    return min($slice) + max($slice);
                }
                if ($sum > $numberToFind) {
                    break;
                }
            }
        }
        return -1;
    }
}
