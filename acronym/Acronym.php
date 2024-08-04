<?php

declare(strict_types=1);

function acronym(string $text): string
{
    preg_match_all('/\b([[:alpha:]])/u', preg_replace('/([[:lower:]])([[:upper:]])/u', '\1 \2', $text), $matches);
    return count($matches[1]) < 2 ? "" : mb_strtoupper(implode("", $matches[1]));
}
