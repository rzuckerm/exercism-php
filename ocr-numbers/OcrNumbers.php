<?php

declare(strict_types=1);

const NUMS = [
    " _     _  _     _  _  _  _  _ ",
    "| |  | _| _||_||_ |_   ||_||_|",
    "|_|  ||_  _|  | _||_|  ||_| _|",
    "                              ",
];

function recognize(array $input): string
{
    return count($input) % 4 || strlen($input[0]) % 3 ?
        throw new \InvalidArgumentException("Invalid input") : implode(",", array_map("_convertRow", array_chunk($input, 4)));
}

function _convertRow(array $row): string
{
    return implode(array_map(fn(int $c): string => _convertCell($row, $c), range(0, strlen($row[0]) - 3, 3)));
}

function _convertCell(array $row, int $c): string
{
    for ($n = 0; $n <= 9; $n++) {
        if (count(array_filter(range(0, 3), fn(int $k): bool => substr($row[$k], $c, 3) == substr(NUMS[$k], $n * 3, 3))) == 4) {
            return (string) $n;
        }
    }

    return "?";
}
