<?php

declare(strict_types=1);

class Allergies
{
    public function __construct(private int $score)
    {
    }

    public function isAllergicTo(Allergen $allergen): bool
    {
        return (bool) ($this->score & $allergen->getScore());
    }

    public function getList(): array
    {
        return array_filter(Allergen::allergenList(), $this->isAllergicTo(...));
    }
}

class Allergen
{
    public const EGGS = 1 << 0;
    public const PEANUTS = 1 << 1;
    public const SHELLFISH = 1 << 2;
    public const STRAWBERRIES = 1 << 3;
    public const TOMATOES = 1 << 4;
    public const CHOCOLATE = 1 << 5;
    public const POLLEN = 1 << 6;
    public const CATS = 1 << 7;

    public function __construct(public int $score)
    {
    }

    public function getScore(): int
    {
        return $this->score;
    }


    public static function allergenList(): array
    {
        $consts = (new ReflectionClass(Allergen::class))->getConstants();
        return array_map(fn(int $allegen): Allergen => new Allergen($allegen), $consts);
    }
}
