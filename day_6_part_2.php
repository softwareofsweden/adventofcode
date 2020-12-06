<?php

include_once "ProblemInterface.php";

class Day6Part2 implements ProblemInterface
{
    public function solve()
    {
        $rows = include 'day_6_input.php';
        $totalCount = 0;
        $questions = "abcdefghijklmnopqrstuvwxyz";
        for ($i = 0; $i < count($rows); $i++) {
            if ($rows[$i] == '') {
                $rows[$i] = ' ';
            } else {
                $rows[$i] .= ',';
            }
        }
        $rows = explode(' ', implode('', $rows));
        foreach ($rows as $row) {
            $nbrPersons = substr_count($row, ',');
            for ($i = 0; $i < strlen($questions); $i++) {
                if (substr_count($row, $questions[$i]) == $nbrPersons) {
                    $totalCount++;
                }
            }
        }
        return $totalCount;
    }
}
