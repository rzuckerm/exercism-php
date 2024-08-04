<?php

declare(strict_types=1);

function rebase(int $fromBase, array $digits, int $toBase): array
{
    if ($fromBase < 2) {
        throw new \InvalidArgumentException("input base must be >= 2");
    }

    if ($toBase < 2) {
        throw new \InvalidArgumentException("output base must be >= 2");
    }

    if (count(array_filter($digits, fn(int $d): bool => $d < 0 || $d >= $fromBase))) {
        throw new \InvalidArgumentException("all digits must satisfy 0 <= d < input base");
    }

    $output = [];
    for ($x = array_reduce($digits, fn(int $acc, int $d): int => $acc * $fromBase + $d, 0); $x > 0; $x = intdiv($x, $toBase)) {
        $output[] = $x % $toBase;
    }

    return $output ? array_reverse($output) : [0];
}
