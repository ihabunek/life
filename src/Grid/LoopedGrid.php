<?php

namespace Bezdomni\Life\Grid;

class LoopedGrid extends InfiniteGrid
{
    protected $width;
    protected $height;

    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function get($x, $y)
    {
        list($x, $y) = $this->normalize($x, $y);

        return parent::get($x, $y);
    }

    public function setAlive($x, $y)
    {
        list($x, $y) = $this->normalize($x, $y);

        return parent::setAlive($x, $y);
    }

    public function setDead($x, $y)
    {
        list($x, $y) = $this->normalize($x, $y);

        return parent::setDead($x, $y);
    }

    protected function normalize($x, $y)
    {
        while ($x > $this->width - 1) {
            $x -= $this->width;
        }

        while ($y > $this->height - 1) {
            $y -= $this->height;
        }

        while ($x < 0) {
            $x += $this->width;
        }

        while ($y < 0) {
            $y += $this->height;
        }

        return [$x, $y];
    }
}
