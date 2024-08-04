<?php

declare(strict_types=1);

class IsbnVerifier
{
    public function isValid(string $isbn): bool
    {
        $a = str_split(strrev(str_replace("-", "", $isbn)));
        if (preg_match('/^(X\d{9}|\d{10})$/', implode($a))) {
            $total = array_sum(array_map(fn(string $x, int $n): int => $n * (($x == "X") ? 10 : $x), $a, range(1, count($a))));
            return $total % 11 == 0;
        }

        return false;
    }
}
