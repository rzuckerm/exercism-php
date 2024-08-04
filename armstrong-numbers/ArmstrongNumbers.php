<?php

declare(strict_types=1);

function isArmstrongNumber(int $number): bool
{
    return $number == array_sum(array_map(fn(string $d): int => $d ** strlen("$number"), str_split("$number")));
}
