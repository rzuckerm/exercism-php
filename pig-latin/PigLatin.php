<?php

declare(strict_types=1);

function translate(string $text): string
{
    return implode(" ", array_map(fn(string $word): string => match (1) {
        preg_match('/^(xr|yt)/', $word) => $word,
        preg_match('/^(y)(.*)/', $word, $m) => "{$m[2]}{$m[1]}",
        preg_match('/^([bcdfghjklmnprstvwxz]*qu)(.*)/', $word, $m) => "{$m[2]}{$m[1]}",
        preg_match('/^([bcdfghjklmnpqrstvwxz]+)(.*)/', $word, $m) => "{$m[2]}{$m[1]}",
        default => $word,
    } . "ay", explode(" ", $text)));
}
