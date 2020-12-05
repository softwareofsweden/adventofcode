<?php

$boardingPasses = include 'day_5_input.php';

$takenSeats = [];

$maxSeatId = 0;
foreach ($boardingPasses as $boardingPass) {
    $row = 0;
    $max = 127;
    for ($i = 0; $i < 7; $i++) {
        $max = $max - (pow(2, (6 - $i)) * ($boardingPass[$i] == 'F' ? 1 : 0));
        $row = $row + (pow(2, (6 - $i)) * ($boardingPass[$i] == 'B' ? 1 : 0));
    }
    $col = 0;
    $max = 7;
    for ($i = 0; $i < 3; $i++) {
        $max = $max - (pow(2, (2 - $i)) * ($boardingPass[$i + 7] == 'L' ? 1 : 0));
        $col = $col + (pow(2, (2 - $i)) * ($boardingPass[$i + 7] == 'R' ? 1 : 0));
    }
    $seatId = ($row * 8) + $col;
    $takenSeats[] = $seatId;
    $maxSeatId = $seatId > $maxSeatId ? $seatId : $maxSeatId;
}

for ($i = 8; $i < 126 * 8; $i++) {
    if (!in_array($i, $takenSeats) && in_array($i - 1, $takenSeats) && in_array($i + 1, $takenSeats)) {
        echo 'The answer is: ' . $i . "\n";
        break;
    }
}



