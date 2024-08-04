<?php

declare(strict_types=1);

function toDecimal(string $number): int
{
    return preg_match('/^[0-2]+$/', $number) ?
        array_reduce(str_split($number), fn(int $acc, string $s): int => 3 * $acc + $s, 0) : 0;
}
