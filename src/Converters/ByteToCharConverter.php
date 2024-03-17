<?php

namespace DS\Generator\Converters;

class ByteToCharConverter extends BaseConverter
{
    public function __construct(protected ?string $encoding = null)
    {
    }

    public function apply(&$value): self
    {
        $value = mb_chr($value, $this->encoding);

        return $this;
    }
}
