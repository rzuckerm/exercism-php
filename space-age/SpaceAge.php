<?php

declare(strict_types=1);

class SpaceAge
{
    private const ORBITS = [
        "earth" => 1.0,
        "mercury" => 0.2408467,
        "venus" => 0.61519726,
        "mars" => 1.8808158,
        "jupiter" => 11.862615,
        "saturn" => 29.447498,
        "uranus" => 84.016846,
        "neptune" => 164.79132,
    ];

    public function __construct(private int $seconds)
    {
    }

    public function __call(string $name, array $arguments)
    {
        return $this->seconds/ 31_557_600.0 / SpaceAge::ORBITS[$name];
    }
}
