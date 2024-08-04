<?php

declare(strict_types=1);

function findFewestCoins(array $coins, int $amount): array
{
    if ($amount < 0) {
        throw new \InvalidArgumentException("Cannot make change for negative value");
    }

    if ($amount < ($min_coin = min($coins)) && $amount > 0) {
        throw new \InvalidArgumentException("No coins small enough to make change");
    }

    $chg = [0 => []];
    for ($t = $min_coin; $t <= $amount; $t++) {
        foreach (array_filter($coins, fn(int $c): bool => $c <= $t) as $c) {
            if (isset($chg[$t - $c]) && (!isset($chg[$t]) || count($chg[$t]) > 1 + count($chg[$t - $c]))) {
                $chg[$t] = [$c, ...$chg[$t - $c]];
            }
        }
    }

    return $chg[$amount] ?? throw new \InvalidArgumentException("No combination can add up to target");
}
