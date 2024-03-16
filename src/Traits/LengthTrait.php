<?php

namespace DS\Generator\Traits;

trait LengthTrait
{
    protected int $length = 0;

    public function getLength(): int
    {
        return $this->length;
    }

    public function setLength(int $length): self
    {
        $this->length = $length;

        return $this;
    }
}