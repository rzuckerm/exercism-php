<?php

declare(strict_types=1);

function brackets_match(string $input): bool
{
    $input = preg_replace('/[^(){}\[\]]/', "", $input);
    do {
        $input = str_replace(["()", "{}", "[]"], "", $input, $count);
    } while ($count > 0);

    return empty($input);
}
