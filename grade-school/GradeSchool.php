<?php

declare(strict_types=1);

class School
{
    private array $students = [];

    public function add(string $name, int $grade): void
    {
        $this->students[$grade][] = $name;
        sort($this->students[$grade]);
    }

    public function grade(int $grade): array
    {
        return array_key_exists($grade, $this->students) ? $this->students[$grade] : [];
    }

    public function studentsByGradeAlphabetical(): array
    {
        ksort($this->students);
        return $this->students;
    }
}
