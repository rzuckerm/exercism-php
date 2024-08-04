<?php

declare(strict_types=1);

function detectAnagrams(string $word, array $anagrams): array
{
    $c = count_chars($w = mb_strtolower($word));
    return array_values(array_filter($anagrams, fn(string $a): bool => $w != ($a = mb_strtolower($a)) && $c == count_chars($a)));
}
