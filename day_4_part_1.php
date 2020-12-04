<?php

$rows = include 'day_4_input.php';
array_push($rows, "");

$requiredFields = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid'];
$optionalFields = ['cid'];

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

echo 'The answer is: ' . $nbrValid . "\n";

