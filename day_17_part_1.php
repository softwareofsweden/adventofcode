<?php

include_once "ProblemInterface.php";

class Day17Part1 implements ProblemInterface
{
    protected $world = [];

    public function expected()
    {
        return 223;
    }

    public function initWorld($input)
    {
        $this->world = [];
        $w = strlen($input[0]);
        $h = count($input);
        $z = 0;
        for ($y = 0; $y < $h; $y++) {
            for ($x = 0; $x < $w; $x++) {
                $this->world[$x . '_' . $y . '_' . $z] = [
                    'x' => $x,
                    'y' => $y,
                    'z' => $z,
                    'status' => $input[$y][$x],
                ];
            }
        }
    }

    public function isCubeActive($x, $y, $z)
    {
        if (isset($this->world[$x . '_' . $y . '_' . $z])) {
            return $this->world[$x . '_' . $y . '_' . $z]['status'] == '#';
        }
        return false;
    }

    public function setCube(&$world, $x, $y, $z, $status)
    {
        $world[$x . '_' . $y . '_' . $z] = [
            'x' => $x,
            'y' => $y,
            'z' => $z,
            'status' => $status,
        ];
    }

    public function countActiveNeighbors($x, $y, $z)
    {
        $count = 0;
        for ($dz = -1; $dz < 2; $dz++) {
            for ($dy = -1; $dy < 2; $dy++) {
                for ($dx = -1; $dx < 2; $dx++) {
                    if (!($dx == 0 && $dy == 0 && $dz == 0)) {
                        if ($this->isCubeActive($x + $dx, $y + $dy, $z + $dz)) {
                            $count++;
                            if ($count > 3) {
                                return 1000;
                            }
                        }
                    }
                }
            }
        }
        return $count;
    }

    public function printWorld()
    {
        $bounds = $this->getWorldBounds();
        for ($z = $bounds['minz']; $z < $bounds['maxz'] + 1; $z++) {
            echo "\n" . 'z=' . $z . "\n";
            for ($y = $bounds['miny']; $y < $bounds['maxy'] + 1; $y++) {
                for ($x = $bounds['minx']; $x < $bounds['maxx'] + 1; $x++) {
                    echo $this->isCubeActive($x, $y, $z) ? '#' : '.';
                }
                echo "\n";
            }
        }
    }

    public function getWorldBounds()
    {
        $result = [
            'minx' => 0,
            'miny' => 0,
            'minz' => 0,
            'maxx' => 0,
            'maxy' => 0,
            'maxz' => 0,
        ];
        foreach ($this->world as $cube) {
            if ($cube['status'] == '#') {
                foreach (['x', 'y', 'z'] as $coord) {
                    if ($cube[$coord] < $result['min' . $coord]) {
                        $result['min' . $coord] = $cube[$coord];
                    }
                    if ($cube[$coord] > $result['max' . $coord]) {
                        $result['max' . $coord] = $cube[$coord];
                    }
                }
            }
        }
        return $result;
    }

    public function simulate()
    {
        $world = $this->world;
        $bounds = $this->getWorldBounds();
        for ($z = $bounds['minz'] - 1; $z < $bounds['maxz'] + 2; $z++) {
            for ($y = $bounds['miny'] - 1; $y < $bounds['maxy'] + 2; $y++) {
                for ($x = $bounds['minx'] - 1; $x < $bounds['maxx'] + 2; $x++) {
                    $activeNeighborsCount = $this->countActiveNeighbors($x, $y, $z);
                    if ($this->isCubeActive($x, $y, $z)) {
                        // If a cube is active and exactly 2 or 3 of its neighbors are also active,
                        // the cube remains active. Otherwise, the cube becomes inactive.
                        if (!($activeNeighborsCount == 2 || $activeNeighborsCount == 3)) {
                            // Inactivate
                            $this->setCube($world, $x, $y, $z, '.');
                        }
                    } else {
                        // If a cube is inactive but exactly 3 of its neighbors are active,
                        // the cube becomes active. Otherwise, the cube remains inactive.
                        if ($activeNeighborsCount == 3) {
                            // Activate
                            $this->setCube($world, $x, $y, $z, '#');
                        }
                    }
                }
            }
        }
        $this->world = $world;
    }

    public function solve()
    {
        $input = include 'day_17_input.php';
        $this->initWorld($input);

        for ($cycle = 0; $cycle < 6; $cycle++) {
            $this->simulate();
        }

        $nbrActive = 0;
        foreach ($this->world as $cube) {
            if ($cube['status'] == '#') {
                $nbrActive++;
            }
        }

        return $nbrActive;
    }
}
