<?php

include_once "ProblemInterface.php";

class Day4Part2 implements ProblemInterface
{
    public function expected()
    {
        return 224;
    }

    function validateHcl($string)
    {
        for ($i = 0; $i < 6; $i++) {
            if (!strstr('0123456789abcdef', $string[$i])) {
                return false;
            }
        }
        return true;
    }

    function validate($value, $field)
    {
        switch ($field) {
            case "byr":
                // byr (Birth Year) - four digits; at least 1920 and at most 2002.
                return intval($value) >= 1920 && intval($value) <= 2002;
            case "iyr":
                // iyr (Issue Year) - four digits; at least 2010 and at most 2020.
                return intval($value) >= 2010 && intval($value) <= 2020;
            case "eyr":
                // eyr (Expiration Year) - four digits; at least 2020 and at most 2030.
                return intval($value) >= 2020 && intval($value) <= 2030;
            case "hgt":
                // hgt (Height) - a number followed by either cm or in:
                if (strstr($value, "cm")) {
                    // If cm, the number must be at least 150 and at most 193.
                    return intval($value) >= 150 && intval($value) <= 193;
                } elseif (strstr($value, "in")) {
                    // If in, the number must be at least 59 and at most 76.
                    return intval($value) >= 59 && intval($value) <= 76;
                } else {
                    return false;
                }
            case "hcl":
                // hcl (Hair Color) - a # followed by exactly six characters 0-9 or a-f.
                return strlen($value) == 7 && $value[0] == '#' && $this->validateHcl(substr($value, 1, 6));
            case "ecl":
                // ecl (Eye Color) - exactly one of: amb blu brn gry grn hzl oth.
                return in_array($value, ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth']);
            case "pid":
                // pid (Passport ID) - a nine-digit number, including leading zeroes.
                return strlen($value) == 9 && is_numeric($value);
        }
        return true;
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
                    if (array_key_exists($requiredField, $passport)) {
                        if (!$this->validate($passport[$requiredField], $requiredField)) {
                            $allKeysOk = false;
                            break;
                        }
                    } else {
                        $allKeysOk = false;
                        break;
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
