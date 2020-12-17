<?php

include_once "ProblemInterface.php";

class Day7Part1 implements ProblemInterface
{
    public function expected()
    {
        return 261;
    }

    public function bagHasBag($allBags, $bag, $find)
    {
        if (array_key_exists($find, $bag)) {
            return true;
        } else {
            foreach ($bag as $innerBag => $count) {
                if ($this->bagHasBag($allBags, $allBags[$innerBag], $find)) {
                    return true;
                }
            }
        }
        return false;
    }

    public function solve()
    {
        $input = include 'day_07_input.php';
        $find = 'shiny gold bag';
        $totalCount = 0;
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
        foreach ($bags as $bag) {
            if ($this->bagHasBag($bags, $bag, $find)) {
                $totalCount++;
            };
        }
        return $totalCount;
    }
}
