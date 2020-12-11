<?php

include_once "ProblemInterface.php";

class Day11Part1 implements ProblemInterface
{

    protected $seatLayout;
    protected $w = 0;
    protected $h = 0;

    public function expected()
    {
        return 2263;
    }

    public function getSeat($x, $y, $seatLayout)
    {
        return $seatLayout[$y][$x];
    }

    public function putSeat($x, $y, $value)
    {
        $this->seatLayout[$y][$x] = $value;
    }

    public function adjacentOccupiedCount($x1, $y1, $seatLayout)
    {
        $count = 0;
        for ($y = -1; $y < 2; $y++) {
            $ry = $y1 + $y;
            if ($ry >= 0 && $ry < $this->h) {
                for ($x = -1; $x < 2; $x++) {
                    $rx = $x1 + $x;
                    if ($rx >= 0 && $rx < $this->w && !($rx == $x1 && $ry == $y1)) {
                        if ($this->getSeat($rx, $ry, $seatLayout) == '#') {
                            $count++;
                        }
                    }
                }
            }
        }
        return $count;
    }

    public function countOccupied()
    {
        $count = 0;
        for ($y = 0; $y < $this->h; $y++) {
            for ($x = 0; $x < $this->w; $x++) {
                if ($this->getSeat($x, $y, $this->seatLayout) == '#') {
                    $count++;
                }
            }
        }
        return $count;
    }

    public function simulate()
    {
        $isChanged = false;
        $seatLayout = $this->seatLayout;
        for ($y = 0; $y < $this->h; $y++) {
            for ($x = 0; $x < $this->w; $x++) {
                $value = $this->getSeat($x, $y, $seatLayout);
                // If a seat is empty (L) and there are no occupied
                // seats adjacent to it, the seat becomes occupied.
                if ($value == 'L' && $this->adjacentOccupiedCount($x, $y, $seatLayout) == 0) {
                    $this->putSeat($x, $y, '#');
                    $isChanged = true;
                }
                // If a seat is occupied (#) and four or more seats adjacent
                // to it are also occupied, the seat becomes empty.
                if ($value == '#' && $this->adjacentOccupiedCount($x, $y, $seatLayout) >= 4) {
                    $this->putSeat($x, $y, 'L');
                    $isChanged = true;
                }
            }
        }
        return $isChanged;
    }

    public function solve()
    {
        $this->seatLayout = include 'day_11_input.php';
        $this->w = strlen($this->seatLayout[0]);
        $this->h = count($this->seatLayout);
        while ($this->simulate()) {
        }
        return $this->countOccupied();
    }
}
