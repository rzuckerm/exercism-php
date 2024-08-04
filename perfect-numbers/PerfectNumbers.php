<?php

declare(strict_types=1);

function getClassification(int $number): string
{
    if ($number < 1) {
        throw new \InvalidArgumentException("Classification is only possible for positive integers.");
    }

    $factors = [];
    for ($i = 1; $i * $i <= $number; $i++) {
        if ($number % $i == 0) {
            array_push($factors, $i, (int) ($number / $i));
        }
    }

    $s = -$number + array_sum(array_unique($factors));
    return ["perfect", "deficient", "abundant"][(int) ($s < $number) + 2 * (int) ($s > $number)];
}
