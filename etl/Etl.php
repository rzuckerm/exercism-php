<?php

declare(strict_types=1);

function transform(array $input): array
{
    return array_merge(...array_map(fn(string $key, array $values): array =>
        array_fill_keys(array_map("strtolower", $values), (int) $key), array_keys($input), array_values($input)));
}
