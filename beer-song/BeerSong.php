<?php

declare(strict_types=1);

class BeerSong
{
    public function verse(int $number): string
    {
        return ucfirst($this->beer($number, " on the wall, ")) . $this->beer($number, ".\n") .
            (($number) ? $this->take($number) : "Go to the store and buy some more, " . $this->beer(99, " on the wall."));
    }

    public function verses(int $start, int $finish): string
    {
        return implode("\n", array_map(fn(int $n): string => $this->verse($n), range($start, $finish)));
    }

    public function lyrics(): string
    {
        return $this->verses(99, 0);
    }

    private function beer(int $number, string $suffix = ""): string
    {
        return (($number < 1) ? "no more" : $number) . " bottle" . (($number != 1) ? "s" : "") . " of beer$suffix";
    }

    private function take(int $number): string
    {
        return "Take " . (($number > 1) ? "one" : "it") .
            " down and pass it around, " . $this->beer($number - 1, " on the wall.\n");
    }
}
