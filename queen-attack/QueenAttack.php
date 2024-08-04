<?php

declare(strict_types=1);

function placeQueen(int $x, int $y): bool
{
    return match (true) {
        $x < 0 || $y < 0 => throw new \InvalidArgumentException("The rank and file numbers must be positive."),
        $x > 7 || $y > 7 => throw new \InvalidArgumentException("The position must be on a standard size chess board."),
        default => true,
    };
}

function canAttack(array $white, array $black): bool
{
    return placeQueen($white[0], $white[1]) && placeQueen($black[0], $black[1]) &&
        ($white[0] == $black[0] || $white[1] == $black[1] || abs($white[0] - $black[0]) == abs($white[1] - $black[1]));
}
