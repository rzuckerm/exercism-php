<?php

declare(strict_types=1);

class BinarySearchTree
{
    public function __construct(public int $data, public ?BinarySearchTree $left = null, public ?BinarySearchTree $right = null)
    {
    }

    public function insert(int $data): void
    {
        $side = ($data <= $this->data) ? "left" : "right";
        is_null($this->$side) ? ($this->$side = new BinarySearchTree($data)) : $this->$side->insert($data);
    }

    public function getSortedData(): array
    {
        return array_merge($this->left?->getSortedData() ?? [], [$this->data], $this->right?->getSortedData() ?? []);
    }
}
