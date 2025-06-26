<?php

declare(strict_types=1);

function winner(array $lines): string
{
    $lines = array_map(fn($line) => str_replace(" ", "", $line), $lines);
    [$nr, $nc] = [count($lines), strlen($lines[0])];
    $ptsArr = ["O" => [], "X" => []];
    $endDims = ["O" => [$nr - 1, $nc - 1], "X" => [$nc - 1, $nr - 1]];
    foreach (["O", "X"] as $p) {
        foreach ($lines as $r => $row) {
            foreach (str_split($row) as $c => $ch) {
                if ($ch == $p) {
                    $ptsArr[$p][] = ($p == "O") ? [$r, $c] : [$c, $r];
                }
            }
        }
    }

    foreach ($ptsArr as $p => $pts) {
        $ends = array_filter(range(0, $endDims[$p][1]), fn(int $c): bool => in_array([$endDims[$p][0], $c], $pts));
        $ends = array_map(fn(int $c): array => [$endDims[$p][0], $c], $ends);
        foreach (array_filter(range(0,  $endDims[$p][1]), fn(int $c): bool => in_array([0, $c], $pts)) as $c) {
            $path = [];
            if (_isWinner($pts, [0, $c], $ends, $path)) {
                return ($p == "O") ? "white" : "black";
            }
        }
    }

    return "";
}

function _isWinner($pts, $pt, $ends, &$path): bool
{
    if (in_array($pt, $ends)) {
        return true;
    }

    foreach ([[-1, 0], [-1, 1], [0, -1], [0, 1], [1, -1], [1, 0]] as $move) {
        $newPt = [$pt[0] + $move[0], $pt[1] + $move[1]];
        if (in_array($newPt, $pts) && !in_array($newPt, $path)) {
            $path[] = $newPt;
            if (_isWinner($pts, $newPt, $ends, $path)) {
                return true;
            }

            array_pop($path);
        }
    }

    return false;
}
