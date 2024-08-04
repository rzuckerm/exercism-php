<?php

declare(strict_types=1);

function factors(int $number): array
{
    $factors = [];
    for ($factor = 2; $number > 1; $factor++) {
        while ($number % $factor == 0) {
            $factors[] = $factor;
            $number = intdiv($number, $factor);
        }
    }

    return $factors;
}
