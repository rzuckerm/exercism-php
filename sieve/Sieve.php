<?php

declare(strict_types=1);

function sieve(int $number): array
{
    $s = array_fill(2, $number - 1, true);
    for ($f = 2; $f * $f <= $number; $f++) {
        if ($s[$f]) {
            for ($k = $f * $f; $k <= $number; $k += $f) {
                $s[$k] = false;
            }
        }
    }

    return array_keys(array_filter($s));
}
