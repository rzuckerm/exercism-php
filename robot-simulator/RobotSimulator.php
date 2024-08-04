<?php

declare(strict_types=1);

class Robot
{
    public const DIRECTION_NORTH = [0, 1];
    public const DIRECTION_EAST = [1, 0];
    public const DIRECTION_SOUTH = [0, -1];
    public const DIRECTION_WEST = [-1, 0];
    private const INSTRUCTIONS = ["L" => "turnLeft", "R" => "turnRight", "A" => "advance"];

    public function __construct(public array $position, public array $direction)
    {
    }

    public function turnRight(): self
    {
        $this->direction = [$this->direction[1], -$this->direction[0]];
        return $this;
    }

    public function turnLeft(): self
    {
        $this->direction = [-$this->direction[1], $this->direction[0]];
        return $this;
    }

    public function advance(): self
    {
        $this->position = [$this->position[0] + $this->direction[0], $this->position[1] + $this->direction[1]];
        return $this;
    }

    public function instructions(string $instructions)
    {
        if (!preg_match("/^[LRA]+$/", $instructions)) {
            throw new \InvalidArgumentException("Invalid instruction");
        }

        $instructions = str_split($instructions);
        array_walk($instructions, fn(string $instruction) => $this->{self::INSTRUCTIONS[$instruction]}());
    }
}
