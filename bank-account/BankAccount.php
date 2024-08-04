<?php

declare(strict_types=1);

class BankAccount
{
    private ?int $amount = null;

    public function open()
    {
        $this->amount = is_null($this->amount) ? 0 : throw new \InvalidArgumentException("account already open");
    }

    public function close(): void
    {
        $this->doIfOpen(fn() => $this->amount = null);
    }

    public function balance(): int
    {
        return $this->doIfOpen(fn(): int => $this->amount);
    }

    public function deposit(int $amt): void
    {
        $this->doIfOpen(fn() => $this->updateBalance($amt, 1));
    }

    public function withdraw(int $amt): void
    {
        $this->doIfOpen(fn() => $this->updateBalance($amt, -1));
    }

    private function doIfOpen(callable $action): mixed
    {
        return is_null($this->amount) ? throw new \InvalidArgumentException("account not open") : $action();
    }

    private function updateBalance(int $amount, int $multiplier): void
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException("amount must be greater than 0");
        }

        $this->amount = ($newAmount = $this->amount + $multiplier * $amount) >= 0 ? $newAmount :
            throw new \InvalidArgumentException("amount must be less than balance");
    }
}
