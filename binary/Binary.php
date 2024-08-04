<?php

declare(strict_types=1);

function parse_binary(string $binary): int
{
    return preg_match('/^[01]+$/', $binary) ? (int) bindec($binary) : throw new \InvalidArgumentException("Invalid binary");
}
