<?php

include_once "ProblemInterface.php";

class Day5Part2 implements ProblemInterface
{
    public function solve()
    {
        $boardingPasses = include 'day_5_input.php';
        $takenSeats = [];
        foreach ($boardingPasses as $boardingPass) {
            $row = 0;
            $col = 0;
            for ($i = 0; $i < 10; $i++) {
                $row = $row + ($i < 7 ? (pow(2, (6 - $i)) * ($boardingPass[$i] == 'B' ? 1 : 0)) : 0);
                $col = $col + ($i > 6 ? (pow(2, (9 - $i)) * ($boardingPass[$i] == 'R' ? 1 : 0)) : 0);
            }
            $takenSeats[] = $row * 8 + $col;
        }
        sort($takenSeats);
        for ($i = 1; $i < count($takenSeats) - 1; $i++) {
            if ($takenSeats[$i + 1] - $takenSeats[$i] == 2) {
                return $takenSeats[$i] + 1;
            }
        }
    }
}
