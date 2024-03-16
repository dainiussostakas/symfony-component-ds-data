<?php

declare(strict_types=1);

namespace DS\Generator;

use DS\Generator\Traits\RangesTrait;
use DS\Generator\Traits\LengthTrait;
use Generator;

class StringGenerator implements IGenerator
{
    protected const DEFAULT_RANGES = [[
        [0x30, 0x0a], // 0-9, total 10(0x0a) characters in range
        [0x41, 0x1a], // A-Z, total 26(0x1a) characters in range
        [0x61, 0x1a], // a-z, total 26(0x1a) characters in range
    ]];

    use RangesTrait;
    use LengthTrait;

    /**
     * @param array $ranges Ranges [offset, length] of unicode code points
     */
    public function __construct(array $ranges = self::DEFAULT_RANGES, int $length = 1)
    {
        $this->ranges = $ranges;
        $this->length = $length;
    }

    public function getGenerator(): Generator
    {
        $generator = new NumberGenerator([
            [0, $this->getLengthOfRange()]
        ]);

        $length = $this->getLength();
        for ($index = 0; $index < $length; $index++) {
            yield $this->getValueByRangeIndex($generator->getValue());
        }
    }

    public function getValue(): string
    {
        $values = [];
        foreach ($this->getGenerator() as $generatedValue) {
            $values[] = mb_chr($generatedValue, "UTF-8");
        }

        return implode($values);
    }
}