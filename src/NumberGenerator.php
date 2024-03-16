<?php

declare(strict_types=1);

namespace DS\Generator;

use DS\Generator\Traits\RangesTrait;
use Generator;

class NumberGenerator implements IGenerator
{
    protected const DEFAULT_RANGES = [
        [PHP_INT_MIN, PHP_INT_MAX]
    ];

    use RangesTrait;

    /**
     * @param array $ranges Ranges [offset, length] of numbers
     */
    public function __construct(array $ranges = self::DEFAULT_RANGES)
    {
        $this->ranges = $ranges;
    }

    public function getGenerator(): Generator
    {
        yield $this->getValueByRangeIndex(rand(0, $this->getLengthOfRange() - 1));
    }

    public function getValue(): int
    {
        return $this->getGenerator()->current();
    }
}