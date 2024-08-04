<?php

declare(strict_types=1);

function maskify(string $cc): string
{
    $n = strlen(preg_replace('/\D/', "", $cc));
    return $n < 6 ? $cc : array_reduce(str_split($cc), fn(string $acc, string $c): string =>
        $acc . ((ctype_digit($c) && ($l = strlen(preg_replace('/[^\d#]/', "", $acc))) > 0 && $l < $n - 4) ? "#" : $c), "");
}
