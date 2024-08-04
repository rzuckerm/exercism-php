<?php

declare(strict_types=1);

function wordCount(string $words): array
{
    preg_match_all('/[a-z0-9]+(?:\'[a-z0-9]+)?/', strtolower($words), $matches);
    return array_count_values($matches[0]);
}
