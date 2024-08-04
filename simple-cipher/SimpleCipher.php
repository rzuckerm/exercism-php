<?php

declare(strict_types=1);

const A = 97;

class SimpleCipher
{
    public string $key;

    public function __construct(string $key = null)
    {
        $this->key = $key ?? implode("", array_map(fn(): string => chr(random_int(A, A + 25)), range(0, 99)));
        if (!$this->key || preg_match("/[^a-z]/", $this->key)) {
            throw new \InvalidArgumentException("Invalid key");
        }
    }

    public function encode(string $plainText): string
    {
        return $this->translate($plainText, fn(int $a, int $b): int => $a + $b);
    }

    public function decode(string $cipherText): string
    {
        return $this->translate($cipherText, fn(int $a, int $b): int => $a - $b);
    }

    private function translate(string $text, callable $func): string
    {
        $result = "";
        $key_len = strlen($this->key);
        foreach (str_split($text) as $n => $c) {
            $result .= chr(($func(ord($text[$n]) - A, ord($this->key[$n % $key_len]) - A) + 26) % 26 + A);
        }

        return $result;
    }
}
