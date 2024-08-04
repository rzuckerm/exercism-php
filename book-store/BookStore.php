<?php

declare(strict_types=1);

const BOOK_PRICE = 8.0;
const DISCOUNT_MULTIPLIER = [0.0, 1.0, 2 * 0.95, 3 * 0.90, 4 * 0.80, 5 * 0.75];

function total(array $items): float
{
    $counts = array_count_values($items);
    rsort($counts);
    return _find_lowest_price($counts);
}

function _find_lowest_price(array $counts): float
{
    $lowest_price = BOOK_PRICE * array_sum($counts);
    $n = count(array_filter($counts));
    for ($i = 2; $i <= $n; $i++) {
        $new_counts = array_map(fn(int $c, int $k): int => $c - ($k < $i), $counts, range(0, count($counts) - 1));
        rsort($new_counts);
        $lowest_price = min($lowest_price, BOOK_PRICE * DISCOUNT_MULTIPLIER[$i] + _find_lowest_price($new_counts));
    }


    return $lowest_price;
}
