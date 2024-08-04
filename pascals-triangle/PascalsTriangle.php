<?php

declare(strict_types=1);

function pascalsTriangleRows(?int $rowCount): array|int
{
    $rows = (($rowCount = $rowCount ?? -1) > 0) ? [[1]] : [];
    for ($l = 1; $l < $rowCount; $l++) {
        $rows[] = array_map(fn(int $n): int => ($rows[$l - 1][$n - 1] ?? 0) + ($rows[$l - 1][$n] ?? 0), range(0, $l));
    }

    return ($rowCount >= 0) ? $rows : -1;
}
