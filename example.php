<?php

use Bezdomni\Life\Grid\InfiniteGrid;
use Bezdomni\Life\Grid\LoopedGrid;
use Bezdomni\Life\Game;
use Bezdomni\Life\Display\ConsoleDisplay;

require 'vendor/autoload.php';

// Setup
$grid = new LoopedGrid(50, 30);
$display = new ConsoleDisplay(50, 30);
$game = new Game($grid, $display);

// Glider
$grid->setAlive(20, 10);
$grid->setAlive(21, 10);
$grid->setAlive(22, 10);
$grid->setAlive(22, 9);
$grid->setAlive(21, 8);

// Blinker
$grid->setAlive(31, 20);
$grid->setAlive(32, 20);
$grid->setAlive(33, 20);

// Go!
$game->play(0.05);