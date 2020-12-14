<?php

include_once "ProblemInterface.php";

class Day14Part2 implements ProblemInterface
{
    public function expected()
    {
        return 4355897790573;
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
                $addr = intval(substr($parts[0], 4, strlen($parts[0]) - 5));
                $value = $parts[1];
                $addr = $addr | base_convert(str_replace('X', '0', $mask), 2, 10);
                $nbr = substr_count($mask, 'X');
                $addr = str_pad(base_convert($addr, 10, 2), 36, '0', STR_PAD_LEFT);
                for ($i = 0; $i < pow(2, $nbr); $i++) {
                    $bits = str_pad(base_convert($i, 10, 2), 36, '0', STR_PAD_LEFT);
                    $bitPos = strlen($bits) - 1;
                    for ($j = strlen($mask) - 1; $j >= 0; $j--)
                    {
                        if ($mask[$j] == 'X') {
                            $addr[$j] = $bits[$bitPos--];
                        }
                    }
                    $memory[base_convert($addr, 2, 10)] = $value;
                }
            }
        }
        return array_sum($memory);
    }
}
