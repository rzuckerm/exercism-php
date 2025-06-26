<?php

declare(strict_types=1);

class Series
{
    public function __construct(private string $input)
    {
    }

    public function largestProduct(int $span): int
    {
        $len = strlen($this->input);
        if (($len && !preg_match("/^[0-9]+$/", $this->input)) || $span < 0 || $span > $len) {
            throw new InvalidArgumentException();
        }

        return ($span) ? max(array_map(fn(int $n): int => array_product(str_split(substr($this->input, $n, $span))), range(0, $len - $span))) : 1;
    }
}
