<?php

include_once "ProblemInterface.php";

class Day18Part1 implements ProblemInterface
{
    public function expected()
    {
        return 21347713555555;
    }

    public function calculateSimpleExpression($expression)
    {
        $result = 0;
        $arr = array_reverse(explode(' ', '+ ' . $expression));
        while (!empty($arr)) {
            $result = eval("return " . $result . array_pop($arr) . array_pop($arr) . ";");
        }
        return $result;
    }

    public function getExpressionDepth($expression)
    {
        $depth = 0;
        $currentDepth = 0;
        for ($i = 0; $i < strlen($expression); $i++) {
            if ($expression[$i] == '(') {
                $currentDepth++;
                if ($currentDepth > $depth) {
                    $depth = $currentDepth;
                }
            }
            if ($expression[$i] == ')') {
                $currentDepth--;
            }
        }
        return $depth;
    }

    public function simplifyExpression($expression, $depth)
    {
        $startPos = 0;
        $length = 0;
        $currentDepth = 0;
        for ($i = 0; $i < strlen($expression); $i++) {
            if ($expression[$i] == '(') {
                $currentDepth++;
                if ($currentDepth == $depth) {
                    $startPos = $i + 1;
                }
            }
            if ($expression[$i] == ')') {
                if ($currentDepth == $depth) {
                    $length = $i - $startPos;
                    break;
                } else {
                    $currentDepth--;
                }

            }
        }
        $subExpression = substr($expression, $startPos, $length);
        $expressionLeft = substr($expression, 0, $startPos - 1);
        $expressionRight = substr($expression, $startPos + $length + 1);
        $this->calculateSimpleExpression($subExpression);
        return $expressionLeft . $this->calculateSimpleExpression($subExpression) . $expressionRight;
    }

    public function calculate($expression)
    {
        $depth = $this->getExpressionDepth($expression);
        while ($depth > 0) {
            $expression = $this->simplifyExpression($expression, $depth);
            $depth = $this->getExpressionDepth($expression);
        }
        return $this->calculateSimpleExpression($expression);
    }

    public function solve()
    {
        $expressions = include 'day_18_input.php';
        $results = [];
        foreach ($expressions as $expression)
        {
            $results[] = $this->calculate($expression);
        }
        return array_sum($results);
    }
}
