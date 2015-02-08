<?php

namespace Bezdomni\Life\Display;

use Bezdomni\Life\DisplayInterface;
use Bezdomni\Life\GridInterface;

class ConsoleDisplay implements DisplayInterface
{
    protected $width;
    protected $height;

    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function show(GridInterface $grid)
    {
        $buffer = "";
        for ($y = 0; $y < $this->height; $y++) {
            for ($x = 0; $x < $this->width; $x++) {
                $value = $grid->get($x, $y);
                $buffer .= $value ? "X" : " ";
            }
            $buffer .= "|\n";
        }

        $buffer .= str_repeat("-", $this->width);
        $buffer .= "+\n";

        echo $buffer;
    }
}
