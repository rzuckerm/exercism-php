<?php

declare(strict_types=1);

class BafflingBirthdays
{
    public function sharedBirthday(array $birthdates): bool
    {
        $birthdays = [];
        foreach ($birthdates as $birthdate) {
            $birthday = substr($birthdate, -5);
            if (isset($birthdays[$birthday])) {
                return true;
            }

            $birthdays[$birthday] = true;
        }

        return false;
    }

    public function randomBirthdates(int $num): array
    {
        $birthdates = [];
        $year = (int) (new DateTime())->format("Y");
        for ($i = 0; $i < $num; $i++) {
            $randYear = random_int($year - 100, $year);
            $randYear += ($randYear % 4 == 0 && ($randYear % 100 != 0 || $randYear % 400 == 0));
            $birthdates[] = (new DateTime())->setDate($randYear, 1, random_int(1, 365))->format("Y-m-d");
        }

        return $birthdates;
    }

    public function estimatedProbabilityOfSharedBirthday(int $groupSize): float
    {
        $trials = 5000;
        $count = 0;
        for ($i = 0; $i < $trials; $i++) {
            $count += $this->sharedBirthday($this->randomBirthdates($groupSize));
        }

        return 100.0 * $count / $trials;
    }
}
