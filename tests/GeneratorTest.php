<?php

declare(strict_types=1);

namespace DS\Generator;

use PHPUnit\Framework\TestCase;

class GeneratorTest extends TestCase
{
    public function testResponse()
    {
        $generator = new Generator();

        $this->assertSame(-1, $generator->saa());
    }
}