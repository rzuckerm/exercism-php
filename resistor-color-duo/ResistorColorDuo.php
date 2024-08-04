<?php

declare(strict_types=1);

const COLORS = ["black", "brown", "red", "orange", "yellow", "green", "blue", "violet", "grey", "white"];

class ResistorColorDuo
{
    public function getColorsValue(array $colors): int
    {
        return (int) 10 * array_search($colors[0], COLORS) + (int) array_search($colors[1], COLORS);
    }
}
