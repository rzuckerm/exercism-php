<?php

declare(strict_types=1);

class Tournament
{
    public function tally(string $scores): string
    {
        $teams = [];
        foreach ($scores ? explode("\n", $scores) : [] as $match) {
            [$team1, $team2, $outcome] = explode(";", $match);
            [$w, $l, $d] = [(int) ($outcome == "win"), (int) ($outcome == "loss"), (int) ($outcome == "draw")];
            $teams[$team1] = $this->get_stats($teams, $team1, $w, $l, $d, 3 * $w + $d);
            $teams[$team2] = $this->get_stats($teams, $team2, $l, $w, $d, 3 * $l + $d);
        }

        // Sort descending by Points (column 5), then ascending by Team (column 0)
        usort($teams, fn(array $a, array $b) => $b[5] <=> $a[5] ?: $a[0] <=> $b[0]);

        $result = "Team                           | MP |  W |  D |  L |  P";
        foreach ($teams as $team)
        {
            $result .= sprintf("\n%-30s | %2d | %2d | %2d | %2d | %2d", ...$team);
        }

        return $result;
    }

    private function get_stats(array $teams, string $t, int $w, int $l, int $d, int $p): array
    {
        // Team (0), Matches (1), Wins (2), Draws (3), Losses (4), Points (5)
        $s = array_key_exists($t, $teams) ? $teams[$t] : [$t, 0, 0, 0, 0, 0];
        return [$s[0], $s[1] + 1, $s[2] + $w, $s[3] + $d, $s[4] + $l, $s[5] + $p];
    }
}
