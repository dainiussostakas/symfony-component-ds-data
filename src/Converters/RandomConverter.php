<?php

namespace DS\Data\Converters;

use DS\Data\Generators\AnyGenerator;
use DS\Data\Ranges\ArrayRange;
use DS\Data\Traits\ConvertersTrait;

class RandomConverter extends BaseConverter
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
         * @var IConverter $value1
         */
        $value1 = $anyGenerator->getValue();
        $value1->apply($value);

        return $this;
    }
}
