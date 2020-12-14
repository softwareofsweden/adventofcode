<?php

include_once "ProblemInterface.php";

class Day12Part2 implements ProblemInterface
{
    public function expected()
    {
        return 63843;
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
        // The waypoint starts 10 units east and 1 unit north relative to the ship.
        // The waypoint is relative to the ship; that is, if the ship moves, the waypoint moves with it.
        $wpx = 10;
        $wpy = -1;
        while (!empty($route)) {
            $instruction = array_pop($route);
            $action = $instruction[0];
            $value = intval(substr($instruction, 1));
            if ($action == 'F') {
                $x += $wpx * $value;
                $y += $wpy * $value;
            } else if ($action == 'L' || $action == 'R') {
                $amount = $value / 90;
                for ($i = 0; $i < $amount; $i++) {
                    if ($action == 'R') {
                        $tmp = $wpy;
                        $wpy = $wpx;
                        $wpx = -$tmp;
                    } else {
                        $tmp = $wpy;
                        $wpy = -$wpx;
                        $wpx = $tmp;
                    }
                }
            } else {
                $moveDir = $dirLookup[$action];
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
                $wpx += $dx;
                $wpy += $dy;
            }
        }
        return abs($x) + abs($y);
    }
}
