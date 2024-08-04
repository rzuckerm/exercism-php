<?php

declare(strict_types=1);

const CLRS = ["black", "brown", "red", "orange", "yellow", "green", "blue", "violet", "grey", "white"];
const ORDERS = ["", "kilo", "mega", "giga"];

class ResistorColorTrio
{
    public function label(array $colors): string
    {
        $value = (10 * array_search($colors[0], CLRS) + array_search($colors[1], CLRS)) * 10 ** array_search($colors[2], CLRS);
        for ($i = 0; $i < count(ORDERS) && $value >= 1000; $i++, $value = (int) ($value / 1000)) {
        }
        return sprintf("%d %sohms", $value, ORDERS[$i]);
    }
}
