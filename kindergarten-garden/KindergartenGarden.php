<?php

declare(strict_types=1);

class KindergartenGarden
{
    const PLANTS = ["V" => "violets", "C" => "clover", "R" => "radishes", "G" => "grass"];
    const PUPILS = ["Alice", "Bob", "Charlie", "David", "Eve", "Fred", "Ginny", "Harriet", "Ileana", "Joseph", "Kincaid", "Larry"];

    private array $diagram;

    public function __construct(string $diagram)
    {
        $rows = array_map("str_split", explode("\n", $diagram));
        $this->diagram = array_map(fn(array $row): array => array_map(fn(string $p): string => self::PLANTS[$p], $row), $rows);
    }

    public function plants(string $student): array
    {
        $k = array_search($student, self::PUPILS) * 2;
        return array_merge(array_slice($this->diagram[0], $k, 2), array_slice($this->diagram[1], $k, 2));
    }
}
