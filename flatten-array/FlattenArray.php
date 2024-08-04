<?php

declare(strict_types=1);

function flatten(array $input): array
{
    return array_merge(...array_map(fn(mixed $a): array => is_array($a) ? flatten($a) : (is_null($a) ? [] : [$a]), $input));
}
