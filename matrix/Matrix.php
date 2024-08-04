<?php

declare(strict_types=1);

class Matrix
{
    private array $matrix;

    public function __construct(string $matrix)
    {
        $this->matrix = array_map(fn(string $row): array => explode(" ", $row), explode("\n", $matrix));
    }

    public function getRow(int $rowId): array
    {
        return $this->matrix[$rowId - 1];
    }

    public function getColumn(int $columnId): array
    {
        return array_column($this->matrix, $columnId - 1);
    }
}
