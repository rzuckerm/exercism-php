<?php

declare(strict_types=1);

function sumOfMultiples(int $number, array $multiples): int
{
    return array_sum(array_unique(array_merge(...array_map(fn(int $m) => ($m > 0 && $m < $number) ?
        range($m, $number - 1 - (($number - 1) % $m), $m) : [], $multiples))));
}
