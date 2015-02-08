<?php

namespace Bezdomni\Life;

/**
 * Rules:
 * - Any live cell with fewer than two live neighbours dies, as if caused by under-population.
 * - Any live cell with two or three live neighbours lives on to the next generation.
 * - Any live cell with more than three live neighbours dies, as if by overcrowding.
 * - Any dead cell with exactly three live neighbours becomes a live cell, as if by reproduction.
 */
class Game
{
    protected $grid;
    protected $display;

    public function __construct(GridInterface $grid, DisplayInterface $display = null)
    {
        $this->grid = $grid;
        $this->display = $display;
    }

    public function tick()
    {
        // Make a snapshot of the grid
        $oldGrid = clone $this->grid;

        // Determine grid bounds
        list($minX, $maxX, $minY, $maxY) = $oldGrid->getBounds();

        // Widen the bounds by 1 so adjacent cells are processed
        $minX -= 1;
        $minY -= 1;
        $maxX += 1;
        $maxY += 1;

        // Iterate inside the bounds
        for ($x = $minX; $x <= $maxX; $x++) {
            for ($y = $minY; $y <= $maxY; $y++) {
                $value = $oldGrid->get($x, $y);
                $lns = $oldGrid->countLiveNeighbours($x, $y);

                if ($value === 1 && ($lns < 2 || $lns > 3)) {
                    $this->grid->setDead($x, $y);
                } elseif ($value === 0 && $lns === 3) {
                    $this->grid->setAlive($x, $y);
                }
            }
        }
    }

    public function play($interval = 0.2)
    {
        $this->display->show($this->grid);

        while (true) {
            $this->tick();
            $this->display->show($this->grid);

            if ($this->grid->isEmpty()) {
                echo "Grid is empty.\n";
                break;
            }

            usleep($interval * 1000000);
        }
    }
}
