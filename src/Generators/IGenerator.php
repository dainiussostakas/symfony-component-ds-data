<?php

declare(strict_types=1);

namespace DS\Data\Generators;

use DS\Data\Converters\IConverter;
use Generator;

/**
 * @template TValue
 */
interface IGenerator
{
    public function getGenerator(): Generator;

    /**
     * @return TValue
     */
    public function getValue(): mixed;

    /**
     * @return IConverter[]
     */
    public function getConverters(): array;

    public function getValueByRangeIndexAndApplyConverters(int $index): mixed;
}
