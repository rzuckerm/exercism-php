<?php

declare(strict_types=1);

class Darts
{
    public int $score = 0;
    private const SCORES = [10, 10, 5, 5, 5, 5, 1, 1, 1, 1, 1];

    public function __construct(float $xAxis, float $yAxis)
    {
        $this->score = self::SCORES[(int) ceil(sqrt($xAxis * $xAxis + $yAxis * $yAxis))] ?? 0;
    }
}
