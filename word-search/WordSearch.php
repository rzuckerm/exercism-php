<?php

declare(strict_types=1);

class WordSearch
{
    private const DIRS = [[1, 0], [1, 1], [0, 1], [-1, 1], [-1, 0], [-1, -1], [0, -1], [1, -1]];

    public function __construct(private array $grid)
    {
    }

    public function search(string $word): ?Result
    {
        $l = strlen($word);
        foreach ($this->grid as $r => $line) {
            foreach (str_split($line) as $c => $_) {
                foreach (self::DIRS as $d) {
                    for ($n = 0; $n < $l; $n++) {
                        [$r2, $c2] = [$r + $d[0] * $n, $c + $d[1] * $n];
                        if ($r2 >= 0 && $c2 >= 0 && isset($this->grid[$r2]) && $word[$n] == substr($this->grid[$r2], $c2, 1)) {
                            if ($n == $l - 1) {
                                return new Result(new Location($r + 1, $c + 1), new Location($r2 + 1, $c2 + 1));
                            }
                        } else {
                            break;
                        }
                    }
                }
            }
        }

        return null;
    }
}
