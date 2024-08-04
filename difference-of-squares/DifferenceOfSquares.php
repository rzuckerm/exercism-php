<?php

function squareOfSum(int $max): int
{
    return (int) ($max * ($max + 1) / 2) ** 2;
}

function sumOfSquares(int $max): int
{
    return (int) ($max * ($max + 1) * (2 * $max + 1) / 6);
}

function difference(int $max): int
{
    return squareOfSum($max) - sumOfSquares($max);
}
