<?php

namespace DS\Data\Ranges;

interface IRange
{
    public function getByIndex(int $index): mixed;

    public function getLength(): int;
}
