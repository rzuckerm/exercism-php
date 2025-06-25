<?php

declare(strict_types=1);

class RobotSimulator
{
    private const INSTRUCTIONS = ["L" => "turnLeft", "R" => "turnRight", "A" => "advance"];
    private const DIRECTIONS = ["north", "east", "south", "west"];
    private const VECTORS = ["north" => [0, 1], "east" => [1, 0], "south" => [0, -1], "west" => [-1, 0]];

    public function __construct(public array $position, public string $direction)
    {
    }

    public function getPosition(): array
    {
        return $this->position;
    }

    public function getDirection(): string
    {
        return $this->direction;
    }

    public function turnRight(): self
    {
        $this->direction = self::DIRECTIONS[(array_search($this->direction, self::DIRECTIONS) + 1) % 4];
        return $this;
    }

    public function turnLeft(): self
    {
        $this->direction = self::DIRECTIONS[(array_search($this->direction, self::DIRECTIONS) + 3) % 4];
        return $this;
    }

    public function advance(): self
    {
        $delta = self::VECTORS[$this->direction];
        $this->position = [$this->position[0] + $delta[0], $this->position[1] + $delta[1]];
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
