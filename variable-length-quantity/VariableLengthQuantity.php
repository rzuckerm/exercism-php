<?php

declare(strict_types=1);

function vlq_encode(array $input): array
{
    return array_reduce(array_map("_encode_number", $input), "array_merge", []);
}

function _encode_number(int $number): array
{
    $b = decbin($number);
    $b = str_split(str_pad($b, 7 * intdiv(strlen($b) + 6, 7), "0", STR_PAD_LEFT), 7);
    return array_map(fn($s, $n) => bindec($s) | (($n != 0) << 7), $b, range(count($b) - 1, 0));
}

function vlq_decode(array $input): array
{
    if ($input && $input[count($input) - 1] & 0x80) {
        throw new \InvalidArgumentException("Incomplete sequence");
    }

    $v = [];
    $number = 0;
    foreach ($input as $x) {
        $number = ($number < 0x200_0000) ? (($number << 7) | ($x & 0x7f)) : throw new \OverflowException();
        if (!($x & 0x80)) {
            $v[] = $number;
            $number = 0;
        }
    }

    return $v;
}
