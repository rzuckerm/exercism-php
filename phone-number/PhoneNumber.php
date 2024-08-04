<?php

declare(strict_types=1);

class PhoneNumber
{
    private string $phoneNumber;

    public function __construct(string $number)
    {
        $number = preg_replace('/[\s().+-]/', "", $number);
        $number = str_starts_with($number, "1") && strlen($number) == 11 ? substr($number, 1) : $number;
        $this->phoneNumber = match (true) {
            strlen($number) < 10 => throw new \InvalidArgumentException("incorrect number of digits"),
            strlen($number) == 11 => throw new \InvalidArgumentException("11 digits must start with 1"),
            strlen($number) > 11 => throw new \InvalidArgumentException("more than 11 digits"),
            (bool) preg_match('/[a-zA-Z]/', $number) => throw new \InvalidArgumentException("letters not permitted"),
            (bool) preg_match('/\D/', $number) => throw new \InvalidArgumentException("punctuations not permitted"),
            $number[0] == "0" => throw new \InvalidArgumentException("area code cannot start with zero"),
            $number[0] == "1" => throw new \InvalidArgumentException("area code cannot start with one"),
            $number[3] == "0" => throw new \InvalidArgumentException("exchange code cannot start with zero"),
            $number[3] == "1" => throw new \InvalidArgumentException("exchange code cannot start with one"),
            default => $number,
        };
    }

    public function number(): string
    {
        return $this->phoneNumber;
    }
}
