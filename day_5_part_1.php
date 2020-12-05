<?php

$boardingPasses = include 'day_5_input.php';

$maxSeatId = 0;

foreach ($boardingPasses as $boardingPass) {
    $row = 0;
    $col = 0;
    for ($i = 0; $i < 10; $i++) {
        $row = $row + ($i < 7 ? (pow(2, (6 - $i)) * ($boardingPass[$i] == 'B' ? 1 : 0)) : 0);
        $col = $col + ($i > 6 ? (pow(2, (9 - $i)) * ($boardingPass[$i] == 'R' ? 1 : 0)) : 0);
    }
    $maxSeatId = $row * 8 + $col > $maxSeatId ? $row * 8 + $col : $maxSeatId;
}

echo 'The answer is: ' . $maxSeatId . "\n";

