<?php

namespace DS\Data\Converters;

class StringRot13Converter extends BaseConverter
{
    public function apply(&$value): self
    {
        $value = str_rot13($value);

        return $this;
    }
}
