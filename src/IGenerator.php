<?php

declare(strict_types=1);

namespace DS\Generator;

use Generator;

interface IGenerator
{
    public function getGenerator(): Generator;

    public function getValue();

    public function getRanges(): array;
}
