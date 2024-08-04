<?php

declare(strict_types=1);

const SUFFIXES = [[], ["th", "st", "nd", "rd"]];

function toOrdinal(int $number): string
{
    return ($number == 0) ? "0" : ($number . (SUFFIXES[($h = $number % 100) < 11 || $h > 13][$number % 10] ?? "th"));
}
