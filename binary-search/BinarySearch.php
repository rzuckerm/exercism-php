<?php

declare(strict_types=1);

function find(int $needle, array $haystack): int
{
    [$low, $high] = [0, count($haystack)];
    while ($low < $high) {
        if ($haystack[$mid = intdiv($low + $high, 2)] == $needle) {
            return $mid;
        }

        [$low, $high] = ($haystack[$mid] < $needle) ? [$mid + 1, $high] : [$low, $mid];
    }

    return -1;
}
