<?php

declare(strict_types=1);

class Minesweeper
{
    public function __construct(private array $minefield)
    {
        $this->minefield = array_map("str_split", $minefield);
    }

    public function annotate(): array
    {
        foreach ($this->minefield as $r => $row) {
            foreach ($row as $c => $ch) {
                foreach ([[-1, -1], [-1, 0], [-1, 1], [0, -1], [0, 1], [1, -1], [1, 0], [1, 1]] as [$dr, $dc]) {
                    if ($ch == " " && ($this->minefield[$r + $dr][$c + $dc] ?? "") == "*") {
                        $this->minefield[$r][$c] = (int) $this->minefield[$r][$c] + 1;
                    }
                }
            }
        }

        return array_map("implode", $this->minefield);
    }
}
