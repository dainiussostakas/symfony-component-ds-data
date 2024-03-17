<?php

namespace DS\Generator\Converters;

use DS\Generator\Generators\AnyGenerator;
use DS\Generator\Ranges\ArrayRange;
use DS\Generator\Traits\ConvertersTrait;

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
