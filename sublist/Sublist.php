<?php

declare(strict_types=1);

class Sublist
{
    public function compare(array $listOne, array $listTwo): string
    {
        if ($listOne === $listTwo) {
            return "EQUAL";
        }

        [$a, $b] = (count($listOne) < count($listTwo)) ? [$listOne, $listTwo] : [$listTwo, $listOne];
        $len =count($b) - ($alen = count($a));
        if (count(array_filter(range(0, $len), fn(int $n): bool => array_slice($b, $n, $alen) == $a))) {
            return (count($listOne) < count($listTwo)) ? "SUBLIST" : "SUPERLIST";
        }

        return "UNEQUAL";
    }
}
