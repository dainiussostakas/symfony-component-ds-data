<?php

declare(strict_types=1);

namespace DS\Generator\Generators;

use DS\Generator\Ranges\IRange;
use DS\Generator\Ranges\NumberOffsetRange;
use Generator;

/** *
 * @template TKey
 * @template TValue
 */
class AnyGenerator extends BaseGenerator
{
    /**
     * @param IRange[] $ranges
     */
    public function __construct(
        array $ranges = []
    ) {
        $this->ranges = $ranges;
    }

    /**
     * @return Generator<TKey, TValue, TValue, TValue>
     */
    public function getGenerator(): Generator
    {
        yield $this->getValueByRangeIndexAndApplyConverters(
            (new NumberGenerator([
                new NumberOffsetRange(0, $this->getLengthOfRange())
            ]))->getValue()
        );
    }

    /**
     * @return TValue
     */
    public function getValue(): mixed
    {
        return $this->getGenerator()->current();
    }
}
