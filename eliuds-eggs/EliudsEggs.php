<?php

declare(strict_types=1);

class EliudsEggs
{
    public function eggCount(int $displayValue): int
    {
        return array_reduce(range(0, 31), fn(int $acc, int $bit): int => $acc + (($displayValue >> $bit) & 1), 0);
    }
}
