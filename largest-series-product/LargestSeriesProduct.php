<?php

declare(strict_types=1);

class Series
{
    public function __construct(private string $input)
    {
    }

    public function largestProduct(int $span): int
    {
        $cnt = strlen($this->input) - $span;
        if (!preg_match("/^[0-9]+$/", $this->input) || $cnt < 0 || $span < 1) {
            throw new InvalidArgumentException();
        }

        return max(array_map(fn(int $n): int => array_product(str_split(substr($this->input, $n, $span))), range(0, $cnt)));
    }
}
