<?php

declare(strict_types=1);

class GradeSchool
{
    private array $students = [];

    public function add(string $name, int $grade): bool
    {
        $should_add = !in_array($name, $this->roster());
        if ($should_add) {
            $this->students[$grade][] = $name;
            sort($this->students[$grade]);
        }

        return $should_add;
    }

    public function grade(int $grade): array
    {
        return array_key_exists($grade, $this->students) ? $this->students[$grade] : [];
    }

    public function roster(): array
    {
        ksort($this->students);
        return array_merge(...$this->students);
    }
}
