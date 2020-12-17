<?php

include_once "ProblemInterface.php";

class Day3Part2 implements ProblemInterface
{
    public function expected()
    {
        return 1718180100;
    }

    public function solve()
    {
        //
        // Time to check the rest of the slopes - you need to minimize the probability of a sudden arboreal stop, after all.
        // What do you get if you multiply together the number of trees encountered on each of the listed slopes?
        //
        $map = include 'day_03_input.php';
        $nbrTreesArr = [];
        $mapWidth = 31;
        $slopes =
            [
                ['right' => 1, 'down' => 1],
                ['right' => 3, 'down' => 1],
                ['right' => 5, 'down' => 1],
                ['right' => 7, 'down' => 1],
                ['right' => 1, 'down' => 2],
            ];
        foreach ($slopes as $slope) {
            $nbrTrees = 0;
            $right = $slope['right'];
            $down = $slope['down'];
            $x = 0;
            for ($y = $down; $y < count($map); $y = $y + $down) {
                $x += $right;
                $xMap = $x % $mapWidth;
                if ($map[$y][$xMap] == '#') {
                    $nbrTrees++;
                }
            }
            $nbrTreesArr[] = $nbrTrees;
        }
        return array_product($nbrTreesArr);
    }
}
