<?php

declare(strict_types=1);

class Proverb
{
    public function recite(array $pieces): array
    {
        return array_merge(
            array_map(fn(string $a, string $b): string =>
                "For want of a $a the $b was lost.", array_slice($pieces, 0, -1), array_slice($pieces, 1)),
            $pieces ? ["And all for the want of a " . $pieces[0] . "."] : []
        );
    }
}
