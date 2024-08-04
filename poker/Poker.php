<?php

declare(strict_types=1);

class Poker
{
    public array $bestHands = [];

    public function __construct(array $hands)
    {
        $rankedHands = array_map("_rankHand", $hands);
        usort($rankedHands, fn(array $a, array $b) => $b[0] <=> $a[0]);
        $bestHands = array_filter($rankedHands, fn(array $rankedHand): bool => $rankedHand[0] == $rankedHands[0][0]);
        $this->bestHands = array_map(fn(array $rankedHand): string => $rankedHand[1], $bestHands);
    }
}

function _isStraight(array $values): bool
{
    return count(array_filter(range(0, 3), fn(int $n): bool => $values[$n] == $values[$n + 1] + 1)) == 4;
}

function _rankHand(string $hand): array
{
    // Convert face value to a number from 2 to 14, where: J=11, Q=12, K=13, A=14,
    // and sort in descending order
    $values = array_map(fn(string $card): string => substr($card, 0, -1), explode(",", $hand));
    $values = array_map(fn(string $v): int => (int) str_replace(["J", "Q", "K", "A"], ["11", "12", "13", "14"], $v), $values);
    rsort($values);

    // Convert Ace Low Straight
    $values = ($values == [14, 5, 4, 3, 2]) ? [5, 4, 3, 2, 1] : $values;

    // Organize values so that values with highest frequency are first and cards with
    // same frequency are in descending order
    $counts = array_count_values($values);
    $counts = array_map(fn(int $v, int $n): array => [$n, $v], array_keys($counts), array_values($counts));
    rsort($counts);
    $orgValues = array_merge(...array_map(fn(array $x): array => array_fill(0, $x[0], $x[1]), $counts));

    // Find best rank based on organized values and whether this is a Flush
    $isFlush = count(array_count_values(array_map(fn(string $card): string => substr($card, -1), explode(",", $hand)))) == 1;
    $rank = match (true) {
        $orgValues[0] == $orgValues[4] => 9, // Five of a kind
        $isFlush && _isStraight($orgValues) => 8, // Straight Flush
        $orgValues[0] == $orgValues[3] => 7, // Four of a Kind
        $orgValues[0] == $orgValues[2] && $orgValues[3] == $orgValues[4] => 6, // Full House
        $isFlush => 5, // Flush
        _isStraight($orgValues) => 4, // Straight
        $orgValues[0] == $orgValues[2] => 3, // Three of a Kind
        $orgValues[0] == $orgValues[1] && $orgValues[2] == $orgValues[3] => 2, // Two Pair
        $orgValues[0] == $orgValues[1] => 1, // One Pair
        default => 0, // High Card
    };
    return [array_merge([$rank], $orgValues), $hand];
}
