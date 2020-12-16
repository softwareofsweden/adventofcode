<?php

include_once "ProblemInterface.php";

class Day11Part2 implements ProblemInterface
{

    protected $seatLayout;
    protected $w = 0;
    protected $h = 0;

    public function expected()
    {
        return 2002;
    }

    public function getSeat($x, $y, $seatLayout)
    {
        return $seatLayout[$y][$x];
    }

    public function putSeat($x, $y, $value)
    {
        $this->seatLayout[$y][$x] = $value;
    }

    public function canSeeOccupied($x1, $y1, $dx, $dy, $seatLayout)
    {
        while (true) {
            $x1 += $dx;
            $y1 += $dy;
            if ($x1 < 0) {
                return false;
            }
            if ($x1 >= $this->w) {
                return false;
            }
            if ($y1 < 0) {
                return false;
            }
            if ($y1 >= $this->h) {
                return false;
            }
            $value = $this->getSeat($x1, $y1, $seatLayout);
            if ($value == 'L') {
                return false;
            }
            if ($value == '#') {
                return true;
            }
        }
    }

    public function visibleOccupiedCount($x1, $y1, $seatLayout)
    {
        $count = 0;
        for ($dy = -1; $dy < 2; $dy++) {
            for ($dx = -1; $dx < 2; $dx++) {
                if (!($dx == 0 && $dy == 0)) {
                    if ($this->canSeeOccupied($x1, $y1, $dx, $dy, $seatLayout)) {
                        $count++;
                    }
                }
            }
        }
        return $count;
    }

    public function moreThanFourVisibleOccupied($x1, $y1, $seatLayout)
    {
        $count = 0;
        for ($dy = -1; $dy < 2; $dy++) {
            for ($dx = -1; $dx < 2; $dx++) {
                if (!($dx == 0 && $dy == 0)) {
                    if ($this->canSeeOccupied($x1, $y1, $dx, $dy, $seatLayout)) {
                        $count++;
                        if ($count > 4) {
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }

    public function noVisibleOccupied($x1, $y1, $seatLayout)
    {
        $count = 0;
        for ($dy = -1; $dy < 2; $dy++) {
            for ($dx = -1; $dx < 2; $dx++) {
                if (!($dx == 0 && $dy == 0)) {
                    if ($this->canSeeOccupied($x1, $y1, $dx, $dy, $seatLayout)) {
                        return false;
                    }
                }
            }
        }
        return true;
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
                // If a seat is empty (L) and there are no visible occupied
                // seats adjacent to it, the seat becomes occupied.
                if ($value == 'L' && $this->noVisibleOccupied($x, $y, $seatLayout)) {
                    $this->putSeat($x, $y, '#');
                    $isChanged = true;
                }
                // Also, people seem to be more tolerant than you expected: it now takes five or
                // more visible occupied seats for an occupied seat to become empty (rather than
                // four or more from the previous rules)
                if ($value == '#' && $this->moreThanFourVisibleOccupied($x, $y, $seatLayout)) {
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
