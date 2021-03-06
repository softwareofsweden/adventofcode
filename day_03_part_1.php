<?php

include_once "ProblemInterface.php";

class Day3Part1 implements ProblemInterface
{
    public function expected()
    {
        return 189;
    }

    public function solve()
    {
        //
        // Starting at the top-left corner of your map and following a slope of right 3
        // and down 1, how many trees would you encounter?
        //
        $map = include 'day_03_input.php';
        $x = 0;
        $nbrTrees = 0;
        $mapWidth = 31;
        for ($y = 1; $y < count($map); $y++) {
            $x += 3;
            $xMap = $x % $mapWidth;
            if ($map[$y][$xMap] == '#') {
                $nbrTrees++;
            }
        }
        return $nbrTrees;
    }
}
