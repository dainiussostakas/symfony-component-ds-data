<?php

namespace DS\Generator\Traits;

trait CountTrait
{
    protected int $count = 0;

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }
}
