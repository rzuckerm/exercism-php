<?php

declare(strict_types=1);

class KillerSudokuHelper
{
    public function combinations(int $sum, int $size, array $exclude): array
    {
        $possiblities = array_values(array_diff(range(1, min($sum, 9)), $exclude));
        $combinations = [];
        foreach ($this->combos($possiblities, $size) as $numbers) {
            if (array_sum($numbers) == $sum) {
                $combinations[] = $numbers;
            }
        }

        return $combinations;
    }

    private function combos(array $pool, int $r)
    {
        // Based on https://docs.python.org/3/library/itertools.html#itertools.combinations
        $n = count($pool);
        $indices = range(0, $r - 1);
        yield array_slice($pool, 0, $r);

        $done = false;
        do {
            $done = true;
            for ($i = $r - 1; $i >= 0; $i--) {
                if ($indices[$i] != $i + $n - $r) {
                    $done = false;
                    break;
                }
            }

            if (!$done) {
                $indices[$i]++;
                for ($j = $i + 1; $j < $r; $j++) {
                    $indices[$j] = $indices[$j - 1] + 1;
                }

                yield array_map(fn(int $i): mixed => $pool[$i], $indices);
            }
        } while (!$done);

        return;
    }
}
