<?php

declare(strict_types=1);

class Triangle
{
    public function __construct(private int|float $a, private int|float $b, private int|float $c)
    {
        if (min($a, $b, $c) <= 0 || $a + $b <= $c || $a + $c <= $b || $b + $c <= $a) {
            throw new Exception("Invalid triangle");
        }
    }

    public function kind(): string
    {
        return match ([$this->a == $this->b, $this->a == $this->c, $this->b == $this->c]) {
            [true, true, true] => "equilateral",
            [false, false, false] => "scalene",
            default => "isosceles",
        };
    }
}
