<?php

include_once "ProblemInterface.php";

class Day7Part2 implements ProblemInterface
{
    public function expected()
    {
        return 3765;
    }

    public function bagCount($allBags, $bag)
    {
        $count = 0;
        foreach ($bag as $innerBag => $c) {
            $count = $count + $c;
            $count += $this->bagCount($allBags, $allBags[$innerBag]) * $c;
        }
        return $count;
    }

    public function solve()
    {
        $input = include 'day_7_input.php';
        $find = 'shiny gold bag';
        $bags = [];
        for ($i = 0; $i < count($input); $i++) {
            $parts = explode('contain ', $input[$i]);
            $parts[0] = trim(str_replace('bags', 'bag', $parts[0]));
            $bags[$parts[0]] = [];
            $content = explode(', ', $parts[1]);
            foreach ($content as $innerBag) {
                $innerBag = trim(str_replace('.', '', $innerBag));
                $count = substr($innerBag, 0, strpos($innerBag, ' '));
                $innerBag = str_replace('bags', 'bag', substr($innerBag, strpos($innerBag, ' ') + 1));
                if ($innerBag != 'other bag') {
                    $bags[$parts[0]][$innerBag] = $count;
                }
            }
        }
        $totalCount = $this->bagCount($bags, $bags[$find]);
        return $totalCount;
    }
}
