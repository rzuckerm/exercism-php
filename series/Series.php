<?php

declare(strict_types=1);

function slices(string $digits, int $series): array
{
    $len = strlen($digits) - $series;
    return $series > 0 && $len >= 0 ? array_map(fn(int $n): string => substr($digits, $n, $series), range(0, $len)) :
        throw new Exception("Invalid series");
}
