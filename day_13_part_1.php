<?php

include_once "ProblemInterface.php";

class Day13Part1 implements ProblemInterface
{
    public function expected()
    {
        return 3882;
    }

    public function solve()
    {
        $data = include 'day_13_input.php';
        $timestamp = intval($data[0]);
        $minTime = $timestamp;
        $minVal = 0;
        foreach (explode(',', $data[1]) as $busId) {
            if ($busId != 'x') {
                $v = $busId - ($timestamp % $busId);
                if ($v < $minTime) {
                    $minTime = $v;
                    $minVal = $minTime * $busId;
                }
            }
        }
        return $minVal;
    }
}
