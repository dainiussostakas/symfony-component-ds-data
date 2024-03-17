<?php

namespace DS\Data\Ranges;

class NumberOffsetRange extends BaseRange
{
    public function __construct(protected int $offset = 0, protected int $length = 1)
    {
    }

    public function getByIndex(int $index): int
    {
        return $this->offset + $index;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }
}
