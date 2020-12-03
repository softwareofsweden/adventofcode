<?php

//
// What is the product of the three entries that sum to 2020?
//

$input = include 'day_1_input.php';

for ($i = 0; $i < count($input); $i++) {
    for ($j = 0; $j < count($input); $j++) {
        for ($k = 0; $k < count($input); $k++) {
            if ($input[$i] + $input[$j] + $input[$k] == 2020) {
                echo 'The answer is: ' . $input[$i] * $input[$j] * $input[$k] . "\n";
                break 3;
            }
        }
    }
}
