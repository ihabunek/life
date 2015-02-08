<?php

namespace Bezdomni\Life\Grid;

use Bezdomni\Life\GridInterface;

class InfiniteGrid implements GridInterface
{
    protected $grid¸= [];

    public function countLiveNeighbours($x, $y)
    {
        $deltas = [[0, 1], [0, -1], [1, 0], [-1, 0], [1, 1], [1, -1], [-1, 1], [-1, -1]];

        $count = 0;
        foreach ($deltas as $delta) {
            list($dx, $dy) = $delta;
            $count += $this->get($x + $dx, $y + $dy);
        }

        return $count;
    }

    public function getBounds()
    {
        if (empty($this->grid)) {
            throw new \Exception("Grid empty");
        }

        $xs = [];
        foreach ($this->grid as $row) {
            $xs = array_unique(array_merge($xs, array_keys($row)));
        }

        $ys = array_keys($this->grid);

        return [min($xs), max($xs), min($ys), max($ys)];
    }

    public function get($x, $y)
    {
        return isset($this->grid[$y][$x]) ? 1 : 0;
    }

    public function setAlive($x, $y)
    {
        $this->grid[$y][$x] = 1;
    }

    public function setDead($x, $y)
    {
        unset($this->grid[$y][$x]);

        if (empty($this->grid[$y])) {
            unset($this->grid[$y]);
        }
    }

    public function isEmpty()
    {
        return empty($this->grid);
    }
}
