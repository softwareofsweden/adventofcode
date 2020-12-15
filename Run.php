<?php

// Load problems
$problems = [];
for ($day = 1; $day < 25; $day++) {
    for ($part = 1; $part < 3; $part++) {
        if (file_exists("day_" . $day . "_part_" . $part . ".php")) {
            include "day_" . $day . "_part_" . $part . ".php";
            $class = "Day" . $day . "Part" . $part;
            $problems[] = new $class();
        }
    }
}

// Execute problems
echo "Task          Result                   Time (ms)                Valid\n";
echo "---------------------------------------------------------------------\n";
$startAll = microtime(true);
foreach ($problems as $problem) {

    if (get_class($problem) != 'Day15Part2') {
        //continue;
    }

    $start = microtime(true);
    $answer = $problem->solve();
    echo str_pad(get_class($problem) . ": ", 14) . str_pad($answer, 25);
    echo str_pad(microtime(true) - $start, 25);
    echo $problem->expected() == $answer ? 'Ok' : 'Error, expected ' . $problem->expected();
    echo "\n";
}
echo "---------------------------------------------------------------------\n";
echo "Total time: " . (microtime(true) - $startAll) . " seconds\n\n";
