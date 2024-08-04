<?php

declare(strict_types=1);

function isPangram(string $string): bool
{
    return strlen(count_chars(preg_replace('/[^a-z]/u', "", mb_strtolower($string)), 3)) == 26;
}
