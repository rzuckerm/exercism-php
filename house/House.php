<?php

declare(strict_types=1);

const LINES = [
    1 => "the house that Jack built.",
    2 => "the malt\nthat lay in",
    3 => "the rat\nthat ate",
    4 => "the cat\nthat killed",
    5 => "the dog\nthat worried",
    6 => "the cow with the crumpled horn\nthat tossed",
    7 => "the maiden all forlorn\nthat milked",
    8 => "the man all tattered and torn\nthat kissed",
    9 => "the priest all shaven and shorn\nthat married",
    10 => "the rooster that crowed in the morn\nthat woke",
    11 => "the farmer sowing his corn\nthat kept",
    12 => "the horse and the hound and the horn\nthat belonged to",
];

class House
{
    public function verse(int $verseNumber): array
    {
        return explode("\n", "This is " . implode(" ", array_map(fn(int $n): string => LINES[$n], range($verseNumber, 1))));
    }

    public function verses(int $start, int $end): array
    {
        return explode("\n", implode("\n\n", array_map(fn(int $n): string =>
            implode("\n", $this->verse($n)), range($start, $end))));
    }
}
