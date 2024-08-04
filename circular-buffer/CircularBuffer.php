<?php

declare(strict_types=1);

class CircularBuffer
{
    private array $buffer;
    private int $readIdx;
    private int $count;

    public function __construct(public int $size)
    {
        $this->buffer = array_fill(0, $size, null);
        $this->clear();
    }

    public function read(): mixed
    {
        $this->count = ($this->count >= 1) ? $this->count - 1 : throw new BufferEmptyError();
        $item = $this->buffer[$this->readIdx];
        $this->readIdx = ($this->readIdx + 1) % $this->size;
        return $item;
    }

    public function write(mixed $item): void
    {
        $this->count = ($this->count < $this->size) ? $this->count + 1 : throw new BufferFullError();
        $this->buffer[($this->readIdx + $this->count - 1) % $this->size] = $item;
    }

    public function forceWrite(mixed $item): void
    {
        if ($this->count >= $this->size) {
            $this->read();
        }

        $this->write($item);
    }

    public function clear(): void
    {
        $this->readIdx = $this->count = 0;
    }
}

class BufferFullError extends Exception
{
}

class BufferEmptyError extends Exception
{
}
