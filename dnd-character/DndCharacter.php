<?php

declare(strict_types=1);

class DndCharacter
{
    const ABILITIES = ["strength", "dexterity", "constitution", "intelligence", "wisdom", "charisma"];
    private array $abilities;

    public function __construct()
    {
        $this->abilities = array_combine(self::ABILITIES, array_map(fn($_): int => self::ability(), self::ABILITIES));
        $this->abilities["hitpoints"] = self::modifier($this->abilities["constitution"]) + 10;
    }

    public function __get(string $name): ?int
    {
        return $this->abilities[$name] ?? null;
    }

    public static function modifier(int $constitution): int
    {
        return intdiv($constitution, 2) - 5;
    }

    public static function ability(): int
    {
        $rolls = array_map(fn(int $n): int => random_int(1, 6), range(1, 4));
        return (int) (array_sum($rolls) - min($rolls));
    }

    public static function generate(): self
    {
        return new self();
    }
}
