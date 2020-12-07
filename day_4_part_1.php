<?php

include_once "ProblemInterface.php";

class Day4Part1 implements ProblemInterface
{
    public function expected()
    {
        return 264;
    }

    public function solve()
    {
        $rows = include 'day_4_input.php';
        array_push($rows, "");
        $requiredFields = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid'];
        $nbrValid = 0;
        $passportData = [];
        foreach ($rows as $row) {
            if ($row == '') {
                $passport = [];
                foreach ($passportData as $passportKeyValue) {
                    $parts = explode(':', $passportKeyValue);
                    $passport[$parts[0]] = $parts[1];
                }
                $allKeysOk = true;
                foreach ($requiredFields as $requiredField) {
                    if (!array_key_exists($requiredField, $passport)) {
                        $allKeysOk = false;
                    }
                }
                if ($allKeysOk) {
                    $nbrValid++;
                }
                $passportData = [];
            } else {
                $passportData = array_merge($passportData, explode(' ', $row));
            }
        }
        return $nbrValid;
    }
}

