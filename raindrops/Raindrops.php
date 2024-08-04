<?php

declare(strict_types=1);

function raindrops(int $number): string
{
    return (($number % 3 ? "" : "Pling") . ($number % 5 ? "" : "Plang") . ($number % 7 ? "" : "Plong")) ?: "$number";
}
