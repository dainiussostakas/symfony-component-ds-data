<?php

declare(strict_types=1);

namespace DS\Data\Generators;

use DS\Data\Ranges\NumberOffsetRange;
use Generator;

class NumberGenerator extends BaseGenerator
{
    public function __construct(
        array $ranges = [
            new NumberOffsetRange(0, PHP_INT_MAX + 1)
        ]
    ) {
        $this->ranges = $ranges;
    }

    public function getGenerator(): Generator
    {
        yield $this->getValueByRangeIndexAndApplyConverters(rand(0, $this->getLengthOfRange() - 1));
    }

    public function getValue(): int
    {
        return $this->getGenerator()->current();
    }
}
