<?php

declare(strict_types=1);

function squareRoot(int $number): int
{
    if ($number < 2) {
        return $number;
    }

    [$prev2, $prev1] = [-1, intdiv($number, 2)];
    while (true) {
        $x1 = intdiv($prev1 + intdiv($number, $prev1), 2);
        if ($x1 == $prev1 || ($x1 == $prev2 && $x1 != $prev1)) {
            return min($x1, $prev1);
        }

        [$prev2, $prev1] = [$prev1, $x1];
    }
}
