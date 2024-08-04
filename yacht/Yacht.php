<?php

declare(strict_types=1);

const NUMS = ["ones" => 1, "twos" => 2, "threes" => 3, "fours" => 4, "fives" => 5, "sixes" => 6];

class Yacht
{
    public function score(array $rolls, string $category): int
    {
        sort($rolls);
        $u = count(array_unique($rolls));
        $r = NUMS[$category] ?? 0;
        return match ($category) {
            "ones", "twos", "threes", "fours", "fives", "sixes" => array_sum(array_filter($rolls, fn(int $d): bool => $d == $r)),
            "full house" => ($u == 2 && $rolls[0] == $rolls[1] && $rolls[3] == $rolls[4]) ? array_sum($rolls) : 0,
            "four of a kind" => ($u <= 2 && $rolls[1] == $rolls[3]) ? 4 * $rolls[1] : 0,
            "little straight" => ($rolls == [1, 2, 3, 4, 5]) ? 30 : 0,
            "big straight" => ($rolls == [2, 3, 4, 5, 6]) ? 30 : 0,
            "yacht" => ($u == 1) ? 50 : 0,
            default => array_sum($rolls),
        };
    }
}
