<?php

declare(strict_types=1);

function crypto_square(string $plaintext): string
{
    $cleaned_text = preg_replace('/[^a-z\d]/', "", strtolower($plaintext));
    $len = strlen($cleaned_text);
    [$r, $c] = [((int) round($q = sqrt($len))), (int) ceil($q)];
    $chunks = ($len <= 1) ? [[$cleaned_text]] : array_map(null, ...array_chunk(str_split($cleaned_text), $c));
    return implode(" ", array_map(fn(array $a): string => str_pad(implode($a), $r), $chunks));
}
