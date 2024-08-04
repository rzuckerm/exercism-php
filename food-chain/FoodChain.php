<?php

declare(strict_types=1);

class FoodChain
{
    const WRIGGLED = "wriggled and jiggled and tickled inside her";
    const SONG = [
        // Animal, 2nd line, 2nd line suffix (if any)
        1 => ["fly", "I don't know why she swallowed the fly. Perhaps she'll die.", ""],
        2 => ["spider", "It " . self::WRIGGLED . ".", " that " . self::WRIGGLED],
        3 => ["bird", "How absurd to swallow a bird!", ""],
        4 => ["cat", "Imagine that, to swallow a cat!", ""],
        5 => ["dog", "What a hog, to swallow a dog!", ""],
        6 => ["goat", "Just opened her throat and swallowed a goat!", ""],
        7 => ["cow", "I don't know how she swallowed a cow!", ""],
        8 => ["horse", "She's dead, of course!", ""],
    ];

    public function verse(int $verseNumber): array
    {
        $lines = ["I know an old lady who swallowed a " . self::SONG[$verseNumber][0] . ".", self::SONG[$verseNumber][1]];
        if ($verseNumber >= 2 && $verseNumber <= 7) {
            for ($n = $verseNumber; $n >= 2; $n--) {
                $lines[] = "She swallowed the " . self::SONG[$n][0] . " to catch the " .
                    self::SONG[$n - 1][0] . self::SONG[$n - 1][2] . ".";
            }

            $lines[] = self::SONG[1][1];
        }

        return $lines;
    }

    public function verses(int $start, int $end): array
    {
        $verses = array_map(fn(int $n): string => implode("\n", $this->verse($n)), range($start, $end));
        return explode("\n", implode("\n\n", $verses));
    }

    public function song(): array
    {
        return $this->verses(1, 8);
    }
}
