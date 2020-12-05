<?php

$boardingPasses = include 'day_5_input.php';

$maxSeatId = 0;

foreach ($boardingPasses as $boardingPass) {
    $row = 0;
    for ($i = 0; $i < 7; $i++) {
        $row = $row + pow(2, (6-$i)) * ($boardingPass[$i] == 'B' ? 1 : 0);
    }
    $col = 0;
    for ($i = 0; $i < 3; $i++) {
        $col = $col + pow(2, (2-$i)) * ($boardingPass[$i+7] == 'R' ? 1 : 0);
    }
    $seatId = $row * 8 + $col;
    $maxSeatId = $seatId > $maxSeatId ? $seatId : $maxSeatId;
}

echo 'The answer is: ' . $maxSeatId . "\n";

