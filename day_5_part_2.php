<?php

$boardingPasses = include 'day_5_input.php';

$takenSeats = [];

foreach ($boardingPasses as $boardingPass) {
    $row = 0;
    $col = 0;
    for ($i = 0; $i < 7; $i++) {
        $row = $row + pow(2, (6 - $i)) * ($boardingPass[$i] == 'B' ? 1 : 0);
    }
    for ($i = 0; $i < 3; $i++) {
        $col = $col + pow(2, (2 - $i)) * ($boardingPass[$i + 7] == 'R' ? 1 : 0);
    }
    $seatId = $row * 8 + $col;
    $takenSeats[] = $seatId;
}

for ($i = 8; $i < 126 * 8; $i++) {
    if (!in_array($i, $takenSeats) && in_array($i - 1, $takenSeats) && in_array($i + 1, $takenSeats)) {
        echo 'The answer is: ' . $i . "\n";
        break;
    }
}
