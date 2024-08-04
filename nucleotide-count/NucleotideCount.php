<?php

declare(strict_types=1);

function nucleotideCount(string $input): array
{
    return preg_match('/[^ACTG]/', $input) ?
        throw new Exception("Invalid input") :
        array_merge(["a" => 0, "c" => 0, "t" => 0, "g" => 0], array_count_values(str_split(strtolower($input))));
}
