<?php

namespace DS\Data\Converters;

class ByteReplaceConverter extends BaseConverter
{
    public function apply(&$value): self
    {
        $value = 0x63;

        return $this;
    }
}
