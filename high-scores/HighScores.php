<?php

declare(strict_types=1);

class HighScores
{
    public int $latest;
    public int $personalBest;
    public array $personalTopThree;

    public function __construct(public array $scores)
    {
        $this->latest = end($scores);
        $this->personalBest = max($scores);
        rsort($scores, SORT_NUMERIC);
        $this->personalTopThree = array_slice($scores, 0, 3);
    }
}
