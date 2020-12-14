<?php

include_once "ProblemInterface.php";

class Day13Part2 implements ProblemInterface
{
    public function expected()
    {
        return 867295486378319;
    }

    public function solve()
    {
        $data = include 'day_13_input.php';
        $data = explode(',', $data[1]);
        $n = 0;
        $inc = $data[0];
        for ($t = 1; $t < count($data); $t++) {
            if ($data[$t] == "x") {
                continue;
            }
            $first = 0;
            while (true) {
                $bus = $data[$t];
                if (($n + $t) % $bus == 0) {
                    if ($first == 0) {
                        if ($t == count($data) - 1) {
                            return $n;
                        }
                        $first = $n;
                    } else {
                        $inc = $n - $first;
                        break;
                    }
                }
                $n += $inc;
            }
        }
        return 0;
    }
}
