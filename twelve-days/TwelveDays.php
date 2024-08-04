<?php

declare(strict_types=1);

const LYRICS = [
    ["first", "a Partridge in a Pear Tree."],
    ["second", "two Turtle Doves, and"],
    ["third", "three French Hens,"],
    ["fourth", "four Calling Birds,"],
    ["fifth", "five Gold Rings,"],
    ["sixth", "six Geese-a-Laying,"],
    ["seventh", "seven Swans-a-Swimming,"],
    ["eighth", "eight Maids-a-Milking,"],
    ["ninth", "nine Ladies Dancing,"],
    ["tenth", "ten Lords-a-Leaping,"],
    ["eleventh", "eleven Pipers Piping,"],
    ["twelfth", "twelve Drummers Drumming,"],
];

class TwelveDays
{
    public function recite(int $start, int $end): string
    {
        return implode(PHP_EOL, array_map("recite_verse", range($start - 1, $end - 1)));
    }
}

function recite_verse(int $n): string
{
    return "On the " . LYRICS[$n][0] . " day of Christmas my true love gave to me: " .
        implode(" ", array_map(fn(int $l): string => LYRICS[$l][1], range($n, 0, -1)));
}
