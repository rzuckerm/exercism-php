<?php

declare(strict_types=1);

function calculate(string $input): int
{
    $OPS = [
        "plus" => fn(int $a, int $b): int => $a + $b,
        "minus" => fn(int $a, int $b): int => $a - $b,
        "multiplied by" => fn(int $a, int $b): int => $a * $b,
        "divided by" => fn(int $a, int $b): int => intdiv($a, $b),
    ];

    [$lhs, $x] = preg_match('/^What is (-?\d+)(.*)\?$/', $input, $m) ?
        [(int) $m[1], $m[2]] : throw new \InvalidArgumentException("Invalid input");
    while ($x) {
        [$lhs, $x] = preg_match('/^ (plus|minus|multiplied by|divided by) (-?\d+)(.*)/', $x, $m) && isset($OPS[$m[1]]) ?
            [$OPS[$m[1]]($lhs, (int) $m[2]), $m[3]] : throw new \InvalidArgumentException("Invalid operation");
    }

    return $lhs;
}
