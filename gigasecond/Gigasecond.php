<?php

declare(strict_types=1);

function from(DateTimeImmutable $date): DateTimeImmutable
{
    return $date->modify("+1000000000 seconds");
}
