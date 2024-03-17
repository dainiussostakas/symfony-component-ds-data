<?php

namespace DS\Data\Traits;

use DS\Data\Ranges\IRange;

trait RangesTrait
{
    protected ?array $rangeIndexMapByPosition = null;

    /**
     * @var IRange[]
     */
    protected array $ranges = [];

    public function getRanges(): array
    {
        return $this->ranges;
    }

    public function getRangeIndexMapByPosition(): ?array
    {
        if ($this->rangeIndexMapByPosition === null && count($this->ranges) > 0) {
            $this->rangeIndexMapByPosition = [0];
            $lengthOfRange = $this->rangeIndexMapByPosition[0];
            $countIterations = count($this->ranges) - 1;

            for ($setIndex = 0; $setIndex < $countIterations; $setIndex++) {
                $lengthOfRange += $this->ranges[$setIndex]->getLength();
                $this->rangeIndexMapByPosition[] = $lengthOfRange;
            }
        }

        return $this->rangeIndexMapByPosition;
    }

    public function getLengthOfRange(): int
    {
        $length = 0;
        $totalSets = count($this->ranges);
        for ($setIndex = 0; $setIndex < $totalSets; $setIndex++) {
            $length += $this->ranges[$setIndex]->getLength();
        }

        return $length;
    }

    public function getValueByRangeIndex(int $index): mixed
    {
        $rangeIndexMapByPosition = $this->getRangeIndexMapByPosition();
        if ($rangeIndexMapByPosition === null) {
            return null;
        }

        for ($rangeIndex = count($rangeIndexMapByPosition) - 1; $rangeIndex >= 0; $rangeIndex--) {
            $rangePosition = $rangeIndexMapByPosition[$rangeIndex];
            $modulo = $index - $rangePosition;
            if ($modulo < 0) {
                continue;
            }

            return $this->ranges[$rangeIndex]->getByIndex($modulo);
        }

        return null;
    }
}
