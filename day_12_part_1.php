<?php

include_once "ProblemInterface.php";

class Day12Part1 implements ProblemInterface
{
    public function expected()
    {
        return 1496;
    }

    public function solve()
    {
        $route = include 'day_12_input.php';
        $route = array_reverse($route);
        $direction = 1; // East
        $dirLookup = [
            'N' => 0,
            'E' => 1,
            'S' => 2,
            'W' => 3,
        ];
        $x = 0;
        $y = 0;
        while (!empty($route)) {
            $instruction = array_pop($route);
            $action = $instruction[0];
            $value = intval(substr($instruction, 1));
            if ($action == 'L' || $action == 'R') {
                $amount = $value / 90;
                $direction += $action == 'L' ? $amount * -1 : $amount;
                // Normalize 0-3
                $direction < 0 ? $direction = 4 + $direction : $direction;
                $direction > 3 ? $direction = $direction - 4: $direction;
            } else {
                $moveDir = $action == 'F' ? $direction : $dirLookup[$action];
                $dx = 0;
                $dy = 0;
                if ($moveDir == 0) { // N
                    $dy = -1 * $value;
                }
                if ($moveDir == 1) { // E
                    $dx = 1 * $value;
                }
                if ($moveDir == 2) { // S
                    $dy = 1 * $value;
                }
                if ($moveDir == 3) { // W
                    $dx = -1 * $value;
                }
                $x += $dx;
                $y += $dy;
            }
        }
        return abs($x) + abs($y);
    }
}
