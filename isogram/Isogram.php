<?php

declare(strict_types=1);

function isIsogram(string $word): bool
{
    $s = mb_str_split(str_replace([" ", "-"], "", mb_strtolower($word)));
    return count($s) == count(array_unique($s));
}
