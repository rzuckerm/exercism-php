<?php

declare(strict_types=1);

const ALPHABET = "abcdefghijklmnopqrstuvwxyz";

function encode(string $text): string
{
    return wordwrap(strtr(preg_replace('/[^a-z0-9]/', "", strtolower($text)), ALPHABET, strrev(ALPHABET)), 5, " ", true);
}
