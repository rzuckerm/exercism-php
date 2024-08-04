<?php

declare(strict_types=1);

const INVERSES = [1, 9, 21, 15, 3, 19, 0, 7, 23, 11, 5, 17, 25];

function encode(string $text, int $num1, int $num2): string
{
    return implode(" ", str_split(_transform($text, $num1, fn(int $x): int => $num1 * $x + $num2), 5));
}

function decode(string $text, int $num1, int $num2): string
{
    return _transform($text, $num1, fn(int $x): int => INVERSES[$num1 >> 1] * ($x - $num2));
}

function _transform(string $text, int $a, callable $f): string
{
    return ($a % 2 == 0 || $a % 13 == 0) ?
        throw new Exception("a and m must be coprime.") :
        implode(array_map(fn(string $c): string => ctype_digit($c) ?
            $c : chr((26 + $f(ord($c) - 97) % 26) % 26 + 97), str_split(preg_replace('/[^a-z0-9]/', "", strtolower($text)))));
}
