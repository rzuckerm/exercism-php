<?php

declare(strict_types=1);

class Knapsack
{
    public function getMaximumValue(int $maximumWeight, array $items): int
    {
        $m = array_fill(0, $maximumWeight + 1, 0);
        foreach ($items as $item) {
            for ($j = $maximumWeight; $j >= $item["weight"]; $j--) {
                $m[$j] = max($m[$j], $m[$j - $item["weight"]] + $item["value"]);
            }
        }

        return $m[$maximumWeight];
    }
}
