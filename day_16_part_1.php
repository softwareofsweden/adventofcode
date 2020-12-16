<?php

include_once "ProblemInterface.php";

class Day16Part1 implements ProblemInterface
{
    public function expected()
    {
        return 32835;
    }

    protected function getRules($input)
    {
        $rules = [];
        foreach ($input as $row) {
            if ($row == '') {
                return $rules;
            }
            $parts = explode(': ', $row);
            $ranges = explode(' or ', $parts[1]);
            $range1 = explode('-', $ranges[0]);
            $range2 = explode('-', $ranges[1]);
            $rules[] = [
                'field' => $parts[0],
                'min1' => $range1[0],
                'max1' => $range1[1],
                'min2' => $range2[0],
                'max2' => $range2[1],
            ];
        }
    }

    protected function getNearbyTickets($input)
    {
        $nearbyTickets = [];
        $found = false;
        foreach ($input as $row) {
            if ($found) {
                $nearbyTickets[] = explode(',', $row);
            }
            if ($row == 'nearby tickets:') {
                $found = true;
            }
        }
        return $nearbyTickets;
    }

    protected function isValueValid($ticketValue, $rules)
    {
        foreach ($rules as $rule) {
            if (
                ($ticketValue >= $rule['min1'] && $ticketValue <= $rule['max1']) ||
                ($ticketValue >= $rule['min2'] && $ticketValue <= $rule['max2'])) {
                return true;
            }
        }
        return false;
    }

    public function solve()
    {
        $input = include 'day_16_input.php';
        $rules = $this->getRules($input);
        $nearbyTickets = $this->getNearbyTickets($input);
        $errorRate = 0;
        foreach ($nearbyTickets as $nearbyTicket) {
            foreach ($nearbyTicket as $ticketValue) {
                if (!$this->isValueValid($ticketValue, $rules)) {
                    $errorRate += $ticketValue;
                }
            }
        }
        return $errorRate;
    }
}
