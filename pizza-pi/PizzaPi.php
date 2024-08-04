<?php

class PizzaPi
{
    public function calculateDoughRequirement(int $pizzas, int $people): int
    {
        return $pizzas * (20 * $people + 200);
    }

    public function calculateSauceRequirement(int $pizzas, int $can_volume): int
    {
        return $pizzas * 125 / $can_volume;
    }

    public function calculateCheeseCubeCoverage(int $side_len, float $thickness, $diameter): int
    {
        return (int) ($side_len ** 3 / (pi() * $thickness * $diameter));
    }

    public function calculateLeftOverSlices(int $pizzas, int $friends): int
    {
        return (8 * $pizzas) % $friends;
    }
}
