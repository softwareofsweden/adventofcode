<?php

include_once "ProblemInterface.php";

class Day14Part1 implements ProblemInterface
{
    public function expected()
    {
        return 9967721333886;
    }

    public function solve()
    {
        $data = include 'day_14_input.php';
        $memory = [];
        $mask = '';
        foreach ($data as $row) {
            $parts = explode(' = ', $row);
            if ($parts[0] == 'mask') {
                $mask = $parts[1];
            } else {
                $addr = substr($parts[0], 4, strlen($parts[0]) - 5);
                $value = intval($parts[1]);
                $value = $value | base_convert(str_replace('X', '0', $mask), 2, 10);
                $value = $value & base_convert(str_replace('X', '1', $mask), 2, 10);
                $memory[$addr] = $value;
            }
        }
        return array_sum($memory);
    }
}
