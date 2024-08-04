<?php

declare(strict_types=1);

const ROMANS = [1000 => "M", 500 => "D", 100 => "C", 50 => "L", 10 => "X", 5 => "V", 1 => "I"];

function toRoman(int $number): string
{
    $result = "";
    foreach (ROMANS as $value => $letters) {
        while ($number >= $value) {
            [$result, $number] = [$result . $letters, $number - $value];
        }
    }

    return str_replace(["DCCCC", "CCCC", "LXXXX", "XXXX", "VIIII", "IIII"], ["CM", "CD", "XC", "XL", "IX", "IV"], $result);
}
