<?php

declare(strict_types=1);

namespace DS\Data\Tests;

use DS\Data\Converters\StringRot13Converter;
use DS\Data\Converters\ValueArrayConverter;
use PHPUnit\Framework\TestCase;

class ConverterTest extends TestCase
{
    /**
     * @var string[]
     */
    protected array $values = [];

    public function setUp(): void
    {
        $this->values = [
            "Az78Sd",
            "UnM334",
            "VcsdSs"
        ];
    }

    public function testValueArrayWhenValueAsArray()
    {
        $valueArrayConverter = new ValueArrayConverter([
            new StringRot13Converter()
        ]);

        $values = $this->values;
        $valueArrayConverter->apply($values);

        $this->assertEqualsCanonicalizing(["Nm78Fq", "HaZ334", "IpfqFf"], $values);
    }
}
