<?php

include_once "ProblemInterface.php";

class Day6Part1 implements ProblemInterface
{
    public function expected()
    {
        return 6703;
    }

    public function solve()
    {
        $rows = include 'day_6_input.php';
        $totalCount = 0;
        $questions = "abcdefghijklmnopqrstuvwxyz";
        for ($i = 0; $i < count($rows); $i++) {
            if ($rows[$i] == '') {
                $rows[$i] = ' ';
            }
        }
        $rows = explode(' ', implode('', $rows));
        foreach ($rows as $row) {
            for ($i = 0; $i < strlen($questions); $i++) {
                if (strstr($row, $questions[$i])) {
                    $totalCount++;
                }
            }
        }
        return $totalCount;
    }
}
