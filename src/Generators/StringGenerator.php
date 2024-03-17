<?php

declare(strict_types=1);

namespace DS\Generator\Generators;

use DS\Generator\Converters\ByteToCharConverter;
use DS\Generator\Ranges\IRange;
use DS\Generator\Ranges\NumberOffsetRange;
use DS\Generator\Traits\LengthTrait;
use Generator;

class StringGenerator extends BaseGenerator
{
    use LengthTrait;

    /**
     * @param IRange[] $ranges Character set ranges by unicode code points
     */
    public function __construct(
        array $ranges = [
            new NumberOffsetRange(0x30, 0x0a),
            new NumberOffsetRange(0x41, 0x1a),
            new NumberOffsetRange(0x61, 0x1a)
        ],
        int $length = 1,
        array $converters = [
            new ByteToCharConverter()
        ]
    ) {
        $this->ranges = $ranges;
        $this->length = $length;
        $this->converters = $converters;
    }

    public function getGenerator(): Generator
    {
        $generator = new NumberGenerator([
            new NumberOffsetRange(0, $this->getLengthOfRange())
        ]);

        $length = $this->getLength();
        for ($index = 0; $index < $length; $index++) {
            yield $this->getValueByRangeIndexAndApplyConverters($generator->getValue());
        }
    }

    public function getValue(): string
    {
        $values = [];
        foreach ($this->getGenerator() as $generatedValue) {
            $values[] = $generatedValue;
        }

        return implode($values);
    }
}
