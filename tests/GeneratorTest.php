<?php

declare(strict_types=1);

namespace DS\Data\Tests;

use DS\Data\Generators\StringGenerator;
use DS\Data\Ranges\IRange;
use DS\Data\Ranges\NumberOffsetRange;
use PHPUnit\Framework\TestCase;

class GeneratorTest extends TestCase
{
    /**
     * @var IRange[]
     */
    protected array $ranges = [];

    public function setUp(): void
    {
        $this->ranges = [
            new NumberOffsetRange(0x30, 0x0a), // [0-9]
            new NumberOffsetRange(0x41, 0x1a), // [A-Z]
            new NumberOffsetRange(0x61, 0x1a), // [a-z]
            new NumberOffsetRange(0x17e), // [Ž]
            new NumberOffsetRange(0x17e), // [ž]
        ];
    }

    public function testWhenLengthIsTen()
    {
        $generator = new StringGenerator($this->ranges, 10);

        $this->assertCount(10, iterator_to_array($generator->getGenerator()));
    }

    public function testWhenLengthIsMinusOne()
    {
        $generator = new StringGenerator($this->ranges, -1);

        $this->assertCount(0, iterator_to_array($generator->getGenerator()));
    }

    public function testWhenLengthIsZero()
    {
        $generator = new StringGenerator($this->ranges, 0);

        $this->assertCount(0, iterator_to_array($generator->getGenerator()));
    }

    public function testMatchPattern()
    {
        $generator = new StringGenerator($this->ranges, 256);

        $this->assertMatchesRegularExpression("/^[0-9A-Za-zŽž]{256}$/u", $generator->getValue());
    }
}
