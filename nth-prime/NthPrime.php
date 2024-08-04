<?php

declare(strict_types=1);

function prime(int $number): int|bool
{
    $p = 1;
    for ($i = 0; $i < $number; $i++) {
        for ($p++; !_isPrime($p); $p++) {
        }
    }

    return ($p >= 2) ? $p : false;
}

function _isPrime(int $p): bool
{
    for ($found = true, $k = 2; $k * $k <= $p && ($found = ($p % $k) != 0); $k++) {
    }

    return $found;
}
