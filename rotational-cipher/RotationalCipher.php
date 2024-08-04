<?php

declare(strict_types=1);

class RotationalCipher
{
    const LETTERS = "abcdefghijklmnopqrstuvwxyz";

    public function rotate(string $text, int $shift): string
    {
        $to = implode(array_map(fn(int $n): string => self::LETTERS[($n + $shift) % 26], range(0, 25)));
        return strtr($text, self::LETTERS . strtoupper(self::LETTERS), $to . strtoupper($to));
    }
}
