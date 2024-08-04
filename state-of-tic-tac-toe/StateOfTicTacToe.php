<?php

declare(strict_types=1);

enum State
{
    case Win;
    case Ongoing;
    case Draw;
}

class StateOfTicTacToe
{
    private const WINS = [[0, 1, 2], [3, 4, 5], [6, 7, 8], [0, 3, 6], [1, 4, 7], [2, 5, 8], [0, 4, 8], [2, 4, 6]];

    public function gameState(array $board): State
    {
        $pieces = str_split(implode($board));
        $counts = array_count_values($pieces);
        [$xs, $os] = [$counts["X"] ?? 0, $counts["O"] ?? 0];
        return match (true) {
            $os > $xs => throw new RuntimeException("Wrong turn order: O started"),
            $xs - $os >= 2 => throw new RuntimeException("Wrong turn order: X went twice"),
            default => match ([$this->wins($pieces, "XXX"), $this->wins($pieces, "OOO")]) {
                    [false, false] => ($xs + $os < 9) ? State::Ongoing : State::Draw,
                    [true, false], [false, true] => State::Win,
                    [true, true] => throw new RuntimeException("Impossible board: game should have ended after the game was won"),
                },
        };
    }

    private function wins(array $pieces, string $winningPieces): bool
    {
        foreach (self::WINS as $pos) {
            if (implode(array_map(fn(int $idx): string => $pieces[$idx], $pos)) == $winningPieces) {
                return true;
            }
        }

        return false;
    }
}
