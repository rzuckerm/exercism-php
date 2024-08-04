<?php

declare(strict_types=1);

function square(int $n): string
{
    return $n >= 1 && $n <= 64 ? sprintf("%u", 1 << ($n - 1)) : throw new \InvalidArgumentException("Invalid square");
}

function total(): string
{
    return sprintf("%u", (1 << 64) - 1);
}
