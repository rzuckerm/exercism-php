<?php

declare(strict_types=1);

class GameOfLife
{
    const DIRECTIONS = [[-1, -1], [-1, 0], [-1, 1], [0, -1], [0, 1], [1, -1], [1, 0], [1, 1]];

    public function __construct(public array $matrix)
    {
    }

    public function tick(): void
    {
        $curr = $this->matrix;
        foreach ($curr as $r => $row) {
            foreach ($row as $c => $cell) {
                $n = array_reduce(GameOfLife::DIRECTIONS, fn($acc, $dir) =>
                    $acc + ((($curr[$r + $dir[0]] ?? [])[$c + $dir[1]] ?? 0) ? 1 : 0), 0);
                $this->matrix[$r][$c] = (int) (($cell && ($n == 2 || $n == 3)) || (!$cell && $n == 3));
            }
        }
    }
}
