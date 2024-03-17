<?php

namespace DS\Data\Ranges;

abstract class BaseRange implements IRange
{
    protected int $length = 0;

    public function getLength(): int
    {
        return $this->length;
    }
}
