<?php

namespace DS\Data\Ranges;

class ArrayRange extends BaseRange
{
    public function __construct(protected array $items = [])
    {
        $this->length = count($this->items);
    }

    public function getByIndex(int $index): mixed
    {
        return $this->items[$index];
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
