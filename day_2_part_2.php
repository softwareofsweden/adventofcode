<?php

//
// Each policy actually describes two positions in the password, where 1 means the first character, 2 means the second character,
// and so on. (Be careful; Toboggan Corporate Policies have no concept of "index zero"!) Exactly one of these positions must contain
// the given letter. Other occurrences of the letter are irrelevant for the purposes of policy enforcement.
//

$passwords = include 'day_2_input.php';

$nbrValid = 0;
for ($i = 0; $i < count($passwords); $i++) {
    $parts = explode(' ', $passwords[$i]);
    $range = explode('-', $parts[0]);
    $pos1 = $range[0] - 1;
    $pos2 = $range[1] - 1;
    $char = $parts[1][0];
    $password = $parts[2];
    $v1 = $password[$pos1] == $char ? 1 : 0;
    $v2 = $password[$pos2] == $char ? 1 : 0;
    if ($v1 + $v2 == 1) {
        $nbrValid++;
    }
}

echo 'The answer is: ' . $nbrValid . "\n";
