<?php

declare(strict_types=1);

function saddlePoints(array $matrix): array
{
    $points = [];
    $maxes = (empty($matrix) || empty($matrix[0])) ? [] : array_map(max(...), $matrix);
    $mins = (count($matrix) > 1) ? array_map(min(...), array_map(null, ...$matrix)) : $matrix[0];
    foreach (array_keys($matrix) as $r) {
        foreach (array_keys($matrix[$r]) as $c) {
            if ($maxes[$r] == $mins[$c]) {
                $points[] = ["row" => $r + 1, "column" => $c + 1];
            }
        }
    }

    return $points;
}
