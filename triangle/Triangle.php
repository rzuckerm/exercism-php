<?php

declare(strict_types=1);

class Triangle
{
    private bool $isValid;

    public function __construct(private int|float $a, private int|float $b, private int|float $c)
    {
        $this->isValid = min($a, $b, $c) > 0 && $a + $b > $c && $a + $c > $b && $b + $c > $a;
    }

    public function isEquilateral(): bool
    {
        return $this->isValid && $this->a == $this->b && $this->a == $this->c && $this->b == $this->c;
    }

    public function isScalene(): bool
    {
        return $this->isValid && $this->a != $this->b && $this->a != $this->c && $this->b != $this->c;
    }

    public function isIsosceles(): bool
    {
        return $this->isValid && !$this->isScalene();
    }
}
