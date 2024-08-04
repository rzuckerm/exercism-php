<?php

declare(strict_types=1);

class Alphametics
{
    public function solve(string $puzzle): ?array
    {
        // Get words
        $words = array_map("trim", preg_split('/\+|==/', $puzzle));
        $nWords = count($words);

        // Separate out first letters from other letters
        $letters = array_unique(str_split(implode($words)));
        $firstLetters = array_unique(array_map(fn(string $w): string => $w[0], $words));
        $otherLetters = array_diff($letters, $firstLetters);
        $letters = array_merge($firstLetters, $otherLetters);
        [$nFirst, $nOther] = [count($firstLetters), count($otherLetters)];

        // Improve runtime by precomputing the multiplier for each letter.
        //
        // Each multiplier is the sum of 10**position of the letter counted from
        // right to left for each word. The left side words added, and the right
        // side word is subtracted. Therefore, the solution will be the combination
        // of letter values multiplied by its corresponding multiplier that adds up
        // to zero
        $multipliers = array_fill_keys($letters, 0);
        foreach ($words as $n => $word) {
            $muliplier = ($n < $nWords - 1) ? 1 : -1;
            foreach (str_split(strrev($word)) as $letter) {
                $multipliers[$letter] += $muliplier;
                $muliplier *= 10;
            }
        }

        // First letters can be 1-9; all other letters can be 0-9. Try all possible
        // values for first letters and other letters. Stop when solution is found
        foreach ($this->permutations(range(1, 9), $nFirst) as $firstValues) {
            if ($nOther < 1) {
                if ($solution = $this->trySolution($letters, $firstValues, $multipliers)) {
                    return $solution;
                }

                continue;
            }

            $candidates = array_values(array_diff(range(0, 9), $firstValues));
            foreach ($this->permutations($candidates, $nOther) as $otherValues) {
                if ($solution = $this->trySolution($letters, array_merge($firstValues, $otherValues), $multipliers)) {
                    return $solution;
                }
            }
        }

        return null;
    }

    private function permutations(array $pool, int $r)
    {
        // Based on https://docs.python.org/3/library/itertools.html#itertools.permutations
        $n = count($pool);
        $indices = range(0, $n - 1);
        $cycles = range($n, $n - $r + 1, -1);
        yield array_slice($pool, 0, $r);

        do {
            $done = true;
            for ($i = $r - 1; $i >= 0; $i--) {
                $cycles[$i]--;
                if ($cycles[$i] == 0) {
                    $indices = array_merge(
                        array_slice($indices, 0, $i),
                        array_slice($indices, $i + 1),
                        array_slice($indices, $i, 1)
                    );
                    $cycles[$i] = $n - $i;
                } else {
                    $k = $n - $cycles[$i];
                    [$indices[$i], $indices[$k]] = [$indices[$k], $indices[$i]];
                    yield array_map(fn(int $k): mixed => $pool[$k], array_slice($indices, 0, $r));
                    $done = false;
                    break;
                }
            }
        } while (!$done);

        return;
    }

    private function trySolution(array $letters, array $values, array $multipliers): ?array
    {
        return (array_sum(array_map(fn(string $k, int $v): int => $v * $multipliers[$k], $letters, $values)) == 0) ?
            array_combine($letters, $values) : null;
    }
}
