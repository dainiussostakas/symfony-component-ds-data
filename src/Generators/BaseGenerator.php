<?php

namespace DS\Data\Generators;

use DS\Data\Traits\ConvertersTrait;
use DS\Data\Traits\RangesTrait;

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
