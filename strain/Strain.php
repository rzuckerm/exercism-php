<?php

declare(strict_types=1);

class Strain
{
    public function keep(array $list, callable $predicate): array
    {
        return array_values(array_filter($list, $predicate));
    }

    public function discard(array $list, callable $predicate): array
    {
        return array_values(array_filter($list, fn(mixed $x): bool => !$predicate($x)));
    }
}
