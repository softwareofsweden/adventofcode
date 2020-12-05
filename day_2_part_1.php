<?php

include_once "ProblemInterface.php";

class Day2Part1 implements ProblemInterface
{
    public function solve()
    {
        //
        // Each line gives the password policy and then the password. The password policy indicates
        // the lowest and highest number of times a given letter must appear for the password to be
        // valid. For example, 1-3 a means that the password must contain a at least 1 time and at
        // most 3 times.
        //
        $passwords = include 'day_2_input.php';
        $nbrValid = 0;
        for ($i = 0; $i < count($passwords); $i++) {
            $parts = explode(' ', $passwords[$i]);
            $range = explode('-', $parts[0]);
            $min = $range[0];
            $max = $range[1];
            $char = $parts[1][0];
            $password = $parts[2];
            $nbrChars = substr_count($password, $char);
            if ($nbrChars >= $min && $nbrChars <= $max) {
                $nbrValid++;
            }
        }
        return $nbrValid;
    }
}
