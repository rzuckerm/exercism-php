<?php

declare(strict_types=1);

class SwiftScheduling
{

    public function __construct(private DateTime $meetingStart)
    {
    }

    public function deliveryDate(string $description): DateTime
    {
        return match (true) {
            $description == "NOW" => $this->meetingStart->modify("+2 hours"),
            $description == "ASAP" => ((int) $this->meetingStart->format("H") < 13) ?
                $this->meetingStart->setTime(17, 0) : $this->meetingStart->setTime(13, 0)->modify("+1 day"),
            $description == "EOW" => (in_array((int) $this->meetingStart->format("w"), [1, 2, 3])) ?
                $this->meetingStart->modify("friday")->setTime(17, 0) :
                $this->meetingStart->modify("sunday")->setTime(20, 0),
            preg_match('/^([1-9]|1[0-2])M$/', $description, $matches) == 1 => $this->convertMFormat((int) $matches[1]),
            preg_match('/^Q([1-4])$/', $description, $matches) == 1 => $this->convertQFormat((int) $matches[1]),
            default => throw new \InvalidArgumentException("Invalid description {$description}")
        };
    }

    private function convertMFormat(int $dueMonth): DateTime
    {
        $yearAdd = ((int) $this->meetingStart->format("m") < $dueMonth) ? 0 : 1;
        $date = clone $this->meetingStart;
        $date->setDate((int) $this->meetingStart->format("Y") + $yearAdd, $dueMonth, 1);
        return ((in_array((int) $date->format("w"), [0, 6])) ? $date->modify("first weekday") : $date)->setTime(8, 0);
    }

    private function convertQFormat(int $dueQuarter): DateTime
    {
        $dueMonth = 3 * $dueQuarter;
        $yearAdd = ((int) $this->meetingStart->format("m") < $dueMonth) ? 0 : 1;
        $date = clone $this->meetingStart;
        $date->setDate((int) $this->meetingStart->format("Y") + $yearAdd, $dueMonth, 1);
        return $date->modify("+1 month, last weekday")->setTime(8, 0);
    }
}
