<?php

declare(strict_types=1);

class BottleSong
{
    const array NUMS = ["no", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten"];

    public function verse(int $number): string
    {
        $line1 = ucFirst($this->bottleLine($number)) . ",\n";
        return "{$line1}{$line1}And if one green bottle should accidentally fall,\n" .
            "There'll be " . $this->bottleLine($number - 1) . ".";
    }

    private function bottleLine(int $number): string
    {
        return BottleSong::NUMS[$number] . " green bottle" . (($number != 1) ? "s" : "") . " hanging on the wall";
    }

    public function verses(int $start, int $size): string
    {
        return implode("\n\n", array_map($this->verse(...), range($start, $start - $size + 1, -1)));
    }

    public function lyrics(): string
    {
        return $this->verses(10, 10);
    }
}
