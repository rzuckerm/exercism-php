<?php

declare(strict_types=1);

class Node
{
    public function __construct(public mixed $value, public ?Node $next = null, public ?Node $prev = null)
    {
    }
}

class LinkedList
{
    private ?Node $head;
    private ?Node $tail;

    public function __construct()
    {
        $this->tail = new Node(null);
        $this->head = new Node(null, next: $this->tail);
        $this->tail->prev = $this->head;
    }

    public function push(mixed $value): void
    {
        $this->add($value, next: $this->tail, prev: $this->tail->prev);
    }

    public function pop(): mixed
    {
        return $this->delete($this->tail->prev);
    }

    public function unshift(mixed $value): void
    {
        $this->add($value, next: $this->head->next, prev: $this->head);
    }

    public function shift(): mixed
    {
        return $this->delete($this->head->next);
    }

    private function add(mixed $value, Node $next, Node $prev): void
    {
        $next->prev = $prev->next = new Node($value, next: $next, prev: $prev);
    }

    private function delete(Node $node): mixed
    {
        $node->prev->next = $node->next;
        $node->next->prev = $node->prev;
        return $node->value;
    }
}
