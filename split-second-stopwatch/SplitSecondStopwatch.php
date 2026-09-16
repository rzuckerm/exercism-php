<?php

declare(strict_types=1);

class SplitSecondStopwatch
{
    public function __construct(
        public $state = "ready",
        private $total = 0,
        private $currentLap = 0,
        public $previousLaps = []
    ) {
    }

    private function formatTime(int $sec): string
    {
        return sprintf("%02d:%02d:%02d", $sec / 3600, ($sec % 3600) / 60, $sec % 60);
    }

    private function getSeconds(string $time): int
    {
        [$h, $m, $s] = explode(":", $time);
        return 3600 * $h + 60 * $m + $s;
    }

    public function getCurrentLap(): string
    {
        return $this->formatTime($this->currentLap);
    }

    public function getTotal(): string
    {
        return $this->formatTime($this->total);
    }

    public function start(): void
    {
        if ($this->state == "running") {
            throw new Exception("cannot start an already running stopwatch");
        }

        $this->state = "running";
    }

    public function advanceTime(string $time): void
    {
        if ($this->state == "running") {
            $seconds = $this->getSeconds($time);
            $this->currentLap += $seconds;
            $this->total += $seconds;
        }
    }

    public function stop(): void
    {
        if ($this->state != "running") {
            throw new Exception("cannot stop a stopwatch that is not running");
        }

        $this->state = "stopped";
    }

    public function lap(): void
    {
        if ($this->state != "running") {
            throw new Exception("cannot lap a stopwatch that is not running");
        }

        $this->previousLaps[] = $this->getCurrentLap();
        $this->currentLap = 0;
    }

    public function reset(): void
    {
        if ($this->state != "stopped") {
            throw new Exception("cannot reset a stopwatch that is not stopped");
        }

        $this->state = "ready";
        $this->total = 0;
        $this->currentLap = 0;
        $this->previousLaps = [];
    }
}
