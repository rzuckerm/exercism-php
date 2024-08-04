<?php

declare(strict_types=1);

const FIRST_10 = ["zero", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine"];
const TEENS = ["ten", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen"];
const MULTIPLES_OF_10 = ["", "", "twenty", "thirty", "forty", "fifty", "sixty", "seventy", "eighty", "ninety"];
const POWERS = [1_000_000_000 => " billion", 1_000_000 => " million", 1_000 => " thousand", 1 => ""];

function say(int $number): string
{
    return match (true) {
        $number < 0 || $number >= 1e12 => throw new \InvalidArgumentException("Input out of range"),
        $number < 20 => array_merge(FIRST_10, TEENS)[$number],
        $number < 100 => MULTIPLES_OF_10[intdiv($number, 10)] . (($x = $number % 10) ? "-" . say($x) : ""),
        $number < 1000 => say(intdiv($number, 100)) . " hundred" . ((($x = $number % 100)) ? " " . say($x) : ""),
        default => implode(" ", array_filter(
            array_map(
                fn(int $d, string $w): string => ($x = intdiv($number, $d) % 1000) ? say($x) . $w : "",
                array_keys(POWERS),
                array_values(POWERS)
            )
        )),
    };
}
