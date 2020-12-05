<?php

$boardingPasses = include 'day_5_input.php';

$takenSeats = [];

foreach ($boardingPasses as $boardingPass) {
    $row = 0;
    $col = 0;
    for ($i = 0; $i < 10; $i++) {
        $row = $row + ($i < 7 ? (pow(2, (6 - $i)) * ($boardingPass[$i] == 'B' ? 1 : 0)) : 0);
        $col = $col + ($i > 6 ? (pow(2, (9 - $i)) * ($boardingPass[$i] == 'R' ? 1 : 0)) : 0);
    }
    $takenSeats[] = $row * 8 + $col;
}

for ($i = 8; $i < 126 * 8; $i++) {
    if (!in_array($i, $takenSeats) && in_array($i - 1, $takenSeats) && in_array($i + 1, $takenSeats)) {
        echo 'The answer is: ' . $i . "\n";
        break;
    }
}
