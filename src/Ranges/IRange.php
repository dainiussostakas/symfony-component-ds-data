<?php

namespace DS\Generator\Ranges;

interface IRange
{
    public function getByIndex(int $index): mixed;

    public function getLength(): int;
}
