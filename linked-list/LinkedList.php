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
    private int $count;

    public function __construct()
    {
        $this->tail = new Node(null);
        $this->head = new Node(null, next: $this->tail);
        $this->tail->prev = $this->head;
        $this->count = 0;
    }

    public function count()
    {
        return $this->count;
    }

    public function push(mixed $value): void
    {
        $this->addNode($value, next: $this->tail, prev: $this->tail->prev);
    }

    public function pop(): mixed
    {
        return $this->deleteNode($this->tail->prev);
    }

    public function unshift(mixed $value): void
    {
        $this->addNode($value, next: $this->head->next, prev: $this->head);
    }

    public function shift(): mixed
    {
        return $this->deleteNode($this->head->next);
    }

    public function delete(mixed $value): void
    {
        for ($node = $this->head; $node != $this->tail; $node = $node->next) {
            if ($value == $node->value) {
                $this->deleteNode($node);
                break;
            }
        }
    }

    private function addNode(mixed $value, Node $next, Node $prev): void
    {
        $next->prev = $prev->next = new Node($value, next: $next, prev: $prev);
        $this->count++;
    }

    private function deleteNode(Node $node): mixed
    {
        $node->prev->next = $node->next;
        $node->next->prev = $node->prev;
        $this->count--;
        return $node->value;
    }
}
