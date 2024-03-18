<?php

namespace DS\Data\Converters;

/**
 * @template TValue
 */
interface IConverter
{
    /**
     * @param TValue $value
     * @return self
     */
    public function apply(&$value): self;
}
