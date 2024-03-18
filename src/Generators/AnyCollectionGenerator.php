<?php

declare(strict_types=1);

namespace DS\Data\Generators;

use DS\Data\Traits\CountTrait;
use Generator;

/**
 * @template TKey
 * @template TValue
 */
class AnyCollectionGenerator implements ICollectionGenerator
{
    use CountTrait;

    /**
     * @param IGenerator $valueGenerator
     * @param int $count
     */
    public function __construct(
        protected IGenerator $valueGenerator,
        int $count = 1
    ) {
        $this->count = $count;
    }

    /**
     * @return Generator<TKey, TValue, TValue, TValue>
     */
    public function getGenerator(): Generator
    {
        $generator = $this->valueGenerator;

        for ($index = 0; $index < $this->count; $index++) {
            yield $generator;
        }
    }

    /**
     * @return array<TValue>
     */
    public function getValues(): array
    {
        $values = [];
        foreach ($this->getGenerator() as $value) {
            $values[] = $value;
        }

        return $values;
    }
}
