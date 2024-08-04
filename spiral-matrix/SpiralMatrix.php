<?php

declare(strict_types=1);

class SpiralMatrix
{
    public function draw(int $n): array
    {
        [$r, $c, $m, $dr, $dc] = [0, 0, 1, 0, 1];
        $matrix = array_fill(0, $n, array_fill(0, $n, 0));
        for ($turnsLeft = 2 * $n - 1; $turnsLeft >= 0; $turnsLeft--) {
            for ($i = 1; $i <= $turnsLeft; $i += 2) {
                [$matrix[$r][$c], $r, $c, $m] = [$m, $r + $dr, $c + $dc, $m + 1];
            }

            [$r, $c, $dr, $dc] = [$r + $dc - $dr, $c - $dc - $dr, $dc, -$dr];
        }

        return $matrix;
    }
}
