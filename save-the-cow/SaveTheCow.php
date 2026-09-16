<?php

declare(strict_types=1);

class SaveTheCow
{
    public function __construct(
        private string $word,
        public $remainingFailures = 9,
        public $state = "Ongoing",
        public string $maskedWord = ""
    ) {
        $this->maskedWord = str_repeat("_", strlen($this->word));
    }

    public function guess(string $letter): void
    {
        if ($this->state != "Ongoing") {
            throw new Exception("cannot guess after the game is " . ($this->state == "Win" ? "won" : "lost"));
        }

        if (str_contains($this->word, $letter) && !str_contains($this->maskedWord, $letter)) {
            foreach (str_split($this->word) as $idx => $ch) {
                if ($ch == $letter) {
                    $this->maskedWord[$idx] = $letter;
                }
            }

            if (!str_contains($this->maskedWord, "_")) {
                $this->state = "Win";
            }
        } else {
            if ($this->remainingFailures > 0) {
                $this->remainingFailures--;
            } else {
                $this->state = "Lose";
            }
        }
    }
}
