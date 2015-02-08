<?php

namespace Bezdomni\Life;

interface GridInterface
{
    public function countLiveNeighbours($x, $y);

    public function getBounds();

    public function get($x, $y);

    public function setAlive($x, $y);

    public function setDead($x, $y);

    public function isEmpty();
}

