<?php

declare(strict_types=1);

namespace DS\Generator;

use ArrayIterator;
use DS\Generator\Traits\CountTrait;
use DS\Generator\Traits\RangesTrait;
use DS\Generator\Traits\LengthTrait;
use Generator;

class StringCollectionGenerator implements IGeneratorCollection
{
    public const DEFAULT_RANGES = [
        [0x30, 0x0a], // 0-9, total 10(0x0a) characters in range
        [0x41, 0x1a], // A-Z, total 26(0x1a) characters in range
        [0x61, 0x1a], // a-z, total 26(0x1a) characters in range
    ];

    use RangesTrait;
    use LengthTrait;
    use CountTrait;

    /**
     * @param array $ranges Ranges [offset, length] by unicode code table
     */
    public function __construct(array $ranges = self::DEFAULT_RANGES, int $length = 1, int $count = 1)
    {
        $this->ranges = $ranges;
        $this->length = $length;
        $this->count = $count;
    }

    public function getGenerator(): Generator
    {
        $generator = new StringGenerator($this->ranges, $this->length);

        for ($index = 0; $index < $this->count; $index++) {
            yield $generator->getValue();
        }
    }

    public function getValues(): ArrayIterator
    {
        $values = new ArrayIterator();
        foreach ($this->getGenerator() as $value) {
            $values->append($value);
        }

        return $values;
    }
}