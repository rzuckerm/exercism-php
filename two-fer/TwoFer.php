<?php

declare(strict_types=1);

function twoFer(string $name = ""): string
{
    return "One for " . ($name ?: "you") . ", one for me.";
}
