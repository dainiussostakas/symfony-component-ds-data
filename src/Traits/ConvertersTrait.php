<?php

namespace DS\Generator\Traits;

use DS\Generator\Converters\IConverter;

trait ConvertersTrait
{
    /**
     * @var IConverter[]
     */
    protected array $converters = [];

    /**
     * @return IConverter[]
     */
    public function getConverters(): array
    {
        return $this->converters;
    }

    /**
     * @param array $converters
     * @return static
     */
    public function setConverters(array $converters): static
    {
        $this->converters = $converters;

        return $this;
    }

    public function applyConverters(&$value): static
    {
        foreach ($this->getConverters() as $converter) {
            $converter->apply($value);
        }

        return $this;
    }
}
