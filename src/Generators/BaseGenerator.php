<?php

namespace DS\Generator\Generators;

use DS\Generator\Traits\ConvertersTrait;
use DS\Generator\Traits\RangesTrait;

abstract class BaseGenerator implements IGenerator
{
    use ConvertersTrait;
    use RangesTrait;

    public function getValueByRangeIndexAndApplyConverters(int $index): mixed
    {
        $value = $this->getValueByRangeIndex($index);
        $this->applyConverters($value);

        return $value;
    }
}
