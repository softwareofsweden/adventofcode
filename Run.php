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
$startAll = microtime(true);
foreach ($problems as $problem) {
    $start = microtime(true);
    echo str_pad(get_class($problem) . ": ", 14) . str_pad($problem->solve(), 25);
    echo microtime(true) - $start;
    echo "\n";
}
echo "Total time: " . (microtime(true) - $startAll) . " seconds\n";
