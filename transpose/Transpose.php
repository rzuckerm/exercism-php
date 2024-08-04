<?php

declare(strict_types=1);

function transpose(array $input): array
{
    $maxlen = max(array_map("strlen", $input));
    $padded = array_map(fn(string $s): array => str_split(str_pad($s, $maxlen, "\0")), $input);
    $tinput = (count($padded) == 1) ? array_chunk($padded[0], 1) : array_map(null, ...$padded);
    return array_map(fn(array $a): string => str_replace("\0", " ", rtrim(implode($a), "\0")), $tinput ?: [[""]]);
}
