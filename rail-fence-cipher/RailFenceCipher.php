<?php

declare(strict_types=1);

function encode(string $plainMessage, int $rails): string
{
    return implode(array_map(fn(int $n): string => $plainMessage[$n], _indices($rails, $plainMessage)));
}

function decode(string $cipherMessage, int $rails): string
{
    $chunks = array_map(null, _indices($rails, $cipherMessage), str_split($cipherMessage));
    sort($chunks);
    return implode(array_map(fn(array $a): string => $a[1], $chunks));
}

function _indices(int $r, string $m): array
{
    $indices = array_map(fn(int $k): array => [(int) abs(($k + $r - 1) % (2 * $r - 2) - $r + 1), $k], range(0, strlen($m) - 1));
    usort($indices, fn(array $a, array $b): int => $a[0] <=> $b[0]);
    return array_map(fn(array $a) => $a[1], $indices);
}
