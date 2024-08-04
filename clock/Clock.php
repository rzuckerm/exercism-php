<?php

declare(strict_types=1);

class Clock
{
    private int $minutes;

    public function __construct(int $hours, int $minutes = 0)
    {
        $this->minutes = (1440 + ($hours * 60 + $minutes) % 1440) % 1440;
    }

    public function __toString(): string
    {
        return sprintf("%02d:%02d", intdiv($this->minutes, 60), $this->minutes % 60);
    }

    public function add(int $minutes): self
    {
        return new self(0, $this->minutes + $minutes);
    }

    public function sub(int $minutes): self
    {
        return new self(0, $this->minutes - $minutes);
    }
}
