<?php

declare(strict_types=1);

function smallest(int $min, int $max): array
{
    return _findPalindromes($min, $max, 1, $max * $max, fn(int $a, int $b): bool => $a <= $b);
}

function largest(int $min, int $max): array
{
    return _findPalindromes($max, $min, -1, 0, fn(int $a, int $b): bool => $a >= $b);
}

function _findPalindromes(int $start, int $end, int $inc, int $initial, callable $comp): array
{
    if ($start * $inc > $end * $inc) {
        throw new Exception("min must be <= max");
    }

    $result = $initial;
    $factors = [];
    foreach (range($start, $end, $inc) as $i) {
        foreach (range($i, $end, $inc) as $j) {
            $n = $i * $j;
            if ($comp($n, $result) && (($s = (string) $n) == strrev($s))) {
                if ($n != $result) {
                    $factors = [];
                }

                $result = $n;
                $factors[] = ($i < $j) ? [$i, $j] : [$j, $i];
            }
        }
    }

    return (count($factors) > 0) ? [$result, $factors] : throw new Exception("No palindromes found");
}
