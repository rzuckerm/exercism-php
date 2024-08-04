<?php

declare(strict_types=1);

const ACTIONS = [0x01 => "wink", 0x02 => "double blink", 0x04 => "close your eyes", 0x08 => "jump"];

class SecretHandshake
{
    public function commands(int $handshake): array
    {
        $actions = array_values(array_filter(array_map(fn(int $m, string $action): string =>
            ($handshake & $m) ? $action : "", array_keys(ACTIONS), array_values(ACTIONS))));
        return ($handshake & 0x10) ? array_reverse($actions) : $actions;
    }
}
