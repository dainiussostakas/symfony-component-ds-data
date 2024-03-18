<?php

namespace DS\Data\Converters;

use DS\Data\Generators\AnyGenerator;
use DS\Data\Ranges\ArrayRange;
use DS\Data\Traits\ConvertersTrait;

class AnyConverter extends BaseConverter
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
        $anyGenerator = new AnyGenerator([
            new ArrayRange($this->converters)
        ]);

        /**
         * @var IConverter $converter
         */
        $converter = $anyGenerator->getValue();
        $converter->apply($value);

        return $this;
    }
}
