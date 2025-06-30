<?php

declare(strict_types=1);

const SCORES = [10, 10, 5, 5, 5, 5, 1, 1, 1, 1, 1];

function score(float $xAxis, float $yAxis): int
{
    return SCORES[(int) ceil(sqrt($xAxis * $xAxis + $yAxis * $yAxis))] ?? 0;
}
