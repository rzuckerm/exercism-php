<?php

declare(strict_types=1);

function diamond(string $letter): array
{
    $n = ord($letter) - ord("A");
    $letters = implode(array_map(fn(int $k): string => chr(ord("A") + (int) abs($k)), range(-$n, $n)));
    $rev_letters = array_map(fn(int $k): string => chr(ord("A") + $n - (int) abs($k)), range(-$n, $n));
    return array_map(fn(string $l): string => preg_replace("/[^$l]/", " ", $letters), $rev_letters);
}
