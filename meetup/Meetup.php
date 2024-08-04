<?php

declare(strict_types=1);

function meetup_day(int $year, int $month, string $which, string $weekday): DateTimeImmutable
{
    return date_create_immutable("$year/$month/" . (($which == "teenth") ? "12" : "1"))->modify(
        ($which == "teenth") ? "next $weekday" : "$which $weekday of this month"
    );
}
