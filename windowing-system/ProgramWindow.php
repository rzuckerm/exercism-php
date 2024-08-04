<?php

require_once 'Size.php';
require_once 'Position.php';

class ProgramWindow
{
    public function __construct(public $x = 0, public $y = 0, public $width = 800, public $height = 600)
    {
    }

    public function resize(Size $size)
    {
        [$this->width, $this->height] = [$size->width, $size->height];
    }

    public function move(Position $position)
    {
        [$this->x, $this->y] = [$position->x, $position->y];
    }
}
