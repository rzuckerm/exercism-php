<?php

declare(strict_types=1);

class Robot
{
    private static array $ROBOT_NAMES = [];
    private string $name;

    public function __construct()
    {
        $this->reset();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function reset(): void
    {
        if (!self::$ROBOT_NAMES) {
            for ($i = 0; $i < 676_000; $i++) {
                $letters = chr((int) ($i / 26000) + ord("A")) . chr((int) ($i / 1000) % 26 + ord("A"));
                self::$ROBOT_NAMES[] = sprintf("%s%03d", $letters, $i % 1000);
            }

            shuffle(self::$ROBOT_NAMES);
        }

        $this->name = array_pop(self::$ROBOT_NAMES);
    }
}
