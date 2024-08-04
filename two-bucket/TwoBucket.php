<?php

declare(strict_types=1);

class TwoBucketSolution
{
    public function __construct(
        public int $numberOfActions,
        public string $nameOfBucketWithDesiredLiters,
        public int $litersLeftInOtherBucket
    ) {
    }
}

class TwoBucket
{
    public int $numberOfActions;
    public string $nameOfBucketWithDesiredLiters;
    public int $litersLeftInOtherBucket;

    public function solve(int $sizeBucketOne, int $sizeBucketTwo, int $goal, string $startBucket): TwoBucketSolution
    {
        $capacities = ($startBucket == "one") ? [$sizeBucketOne, $sizeBucketTwo] : [$sizeBucketTwo, $sizeBucketOne];
        $bucketNames = ($startBucket == "one") ? ["one", "two"] : ["two", "one"];

        // Starting bucket is full, other bucket is empty
        $buckets = [$capacities[0], 0];

        // Keep going until goal is met is with either bucket or too many moves
        for ($i = 1; $i <= 100; $i++) {
            // Goal met with either bucket
            if (($whichBucket = $buckets[1] == $goal) || $buckets[0] == $goal) {
                return new TwoBucketSolution($i, $bucketNames[$whichBucket], $buckets[1 - $whichBucket]);
            }

            if ($capacities[1] == $goal) {
                // Fill other bucket if goal can be met with it
                $buckets[1] = $goal;
            } else if ($buckets[1] == $capacities[1]) {
                // Empty other bucket if full
                $buckets[1] = 0;
            } else if ($buckets[0] == 0) {
                // Fill start bucket if empty
                $buckets[0] = $capacities[0];
            } else {
                // Otherwise, pour maximum amount from one bucket into the other
                $buckets = [max(0, $buckets[0] - $capacities[1] + $buckets[1]), min($buckets[1] + $buckets[0], $capacities[1])];
            }
        }

        throw new Exception("No solution");
    }
}
