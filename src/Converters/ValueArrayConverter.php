<?php

namespace DS\Data\Converters;

use DS\Data\Traits\ConvertersTrait;

class ValueArrayConverter extends BaseConverter
{
    use ConvertersTrait;

    /**
     * @param IConverter[] $converters
     */
    public function __construct(array $converters)
    {
        $this->converters = $converters;
    }

    public function apply(&$value): self
    {
        foreach ($value as &$item) {
            $this->applyConverters($item);
        }

        return $this;
    }
}
