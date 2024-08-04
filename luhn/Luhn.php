<?php

declare(strict_types=1);

function isValid(string $number): bool
{
    $s = str_split(str_replace(" ", "", strrev($number)));
    if (count($s) < 2 || array_filter($s, fn(string $c): int => preg_match("/[^0-9]/", $c))) {
        return false;
    }

    array_walk($s, fn(string &$c, int $n): int => $c = ($n % 2) ? 2 * ($c % 5) + (int) ($c / 5) : (int) $c);
    return array_sum($s) % 10 == 0;
}
