<?php

declare(strict_types=1);

final class Location {
    public function __construct(private readonly int $row, private readonly int $column) {
    }
}
