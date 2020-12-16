<?php

include_once "ProblemInterface.php";

class Day16Part2 implements ProblemInterface
{
    public function expected()
    {
        return 514662805187;
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

    protected function getMyTicket($input)
    {
        $found = false;
        foreach ($input as $row) {
            if ($found) {
                return explode(',', $row);
            }
            if ($row == 'your ticket:') {
                $found = true;
            }
        }
        return [];
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

    protected function isValueValidForRule($ticketValue, $rule)
    {
        return ($ticketValue >= $rule['min1'] && $ticketValue <= $rule['max1']) ||
            ($ticketValue >= $rule['min2'] && $ticketValue <= $rule['max2']);
    }

    protected function getTicketValuesForField($tickets, $fieldIndex)
    {
        $values = [];
        foreach ($tickets as $ticket) {
            $values[] = $ticket[$fieldIndex];
        }
        return $values;
    }

    public function solve()
    {
        $input = include 'day_16_input.php';

        $rules = $this->getRules($input);
        $nearbyTickets = $this->getNearbyTickets($input);
        $myTicket = $this->getMyTicket($input);

        // Get rid of invalid tickets
        $validTickets = [];
        foreach ($nearbyTickets as $nearbyTicket) {
            $ticketValid = true;
            foreach ($nearbyTicket as $ticketValue) {
                if (!$this->isValueValid($ticketValue, $rules)) {
                    $ticketValid = false;
                    break;
                }
            }
            if ($ticketValid) {
                $validTickets[] = $nearbyTicket;
            }
        }

        // Check which rules that are valid for each field
        $validRulesForFields = [];
        for ($fieldIdx = 0; $fieldIdx < count($rules); $fieldIdx++) {
            $validRulesForFields[$fieldIdx] = [];
            for ($ruleIdx = 0; $ruleIdx < count($rules); $ruleIdx++) {
                $valuesForField = $this->getTicketValuesForField($validTickets, $fieldIdx);
                $allValuesOk = true;
                foreach ($valuesForField as $value) {
                    if (!$this->isValueValidForRule($value, $rules[$ruleIdx])) {
                        $allValuesOk = false;
                        break;
                    }
                }
                if ($allValuesOk) {
                    $validRulesForFields[$fieldIdx][] = $rules[$ruleIdx]['field'];
                }
            }
        }

        // Clean up mapped rules
        $completedRules = [];
        while (count($completedRules) != 20) {
            for ($i = 0; $i < count($validRulesForFields); $i++) {
                $ruleName = reset($validRulesForFields[$i]);
                if (count($validRulesForFields[$i]) == 1 && !in_array($ruleName, $completedRules)) {
                    $completedRules[] = $ruleName;
                    for ($j = 0; $j < count($validRulesForFields); $j++) {
                        if (count($validRulesForFields[$j]) > 1 && in_array($ruleName, $validRulesForFields[$j])) {
                            $key = array_search($ruleName, $validRulesForFields[$j]);
                            unset($validRulesForFields[$j][$key]);
                        }
                    }

                }
            }
        }

        $myTicketValues = [];
        foreach ($validRulesForFields as $fieldIdx => $field) {
            if (strpos(reset($field), 'departure') === 0) {
                $myTicketValues[] = $myTicket[$fieldIdx];
            }
        }

        return array_product($myTicketValues);
    }
}
