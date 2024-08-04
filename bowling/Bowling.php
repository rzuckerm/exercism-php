<?php

declare(strict_types=1);

class Game
{
    private array $rolls = [];
    private array $currFrame = [];
    private int $frame = 0;

    public function score(): int
    {
        if ($this->frame < 10) {
            throw new Exception("Game is not over");
        }

        [$total, $n] = [0, 0];
        for ($i = 0; $i < 10; $i++) {
            $frame_total = $this->rolls[$n] + $this->rolls[$n + 1];
            $total += $frame_total + (($this->rolls[$n] == 10 || $frame_total == 10) ? $this->rolls[$n + 2] : 0);
            $n += ($this->rolls[$n] == 10) ? 1 : 2;
        }

        return $total;
    }

    public function roll(int $pins): void
    {
        if ($this->frame >= 10 || $pins < 0 || $pins > 10 - array_sum($this->currFrame) % 10) {
            throw new \InvalidArgumentException("Invalid roll");
        }

        $this->rolls[] = $pins;
        $this->currFrame[] = $pins;
        [$nr, $total] = [count($this->currFrame), array_sum($this->currFrame)];
        if ($nr == 3 || ($this->frame < 9 && ($nr == 2 || $total == 10)) || ($this->frame >= 9 && $nr == 2 && $total < 10)) {
            $this->frame++;
            $this->currFrame = [];
        }
    }
}
