<?php

declare(strict_types=1);

class Bob
{
    public function respondTo(string $str): string
    {
        $s = preg_replace("/^\s+|\s+$/u", "", $str);
        $ltrs = preg_replace("/[^[[:alpha:]]/u", "", $s);

        // bit 2        | bit 1    | bit 0    ||
        // empty string | question | all caps || result
        // 0            | 0        | 0        || Whatever.
        // 0            | 0        | 1        || Whoa, chill out!
        // 0            | 1        | 0        || Sure.
        // 0            | 1        | 1        || Calm down, I know what I'm doing!
        // 1            | 0        | 0        || Fine. Be that way!
        $code = (int) (!$s) * 4 + (int) (preg_match("/\\?$/u", $s)) * 2 + (int) ($ltrs && $ltrs === mb_strtoupper($ltrs));
        return ["Whatever.", "Whoa, chill out!", "Sure.", "Calm down, I know what I'm doing!", "Fine. Be that way!"][$code];
    }
}
