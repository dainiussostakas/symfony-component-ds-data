<?php

declare(strict_types=1);

namespace DS\Data\Tests;

use DS\Data\Converters\AlphaToNumberConverter;
use DS\Data\Converters\ByteToCharConverter;
use DS\Data\Converters\IConverter;
use DS\Data\Converters\AnyConverter;
use DS\Data\Converters\StringRot13Converter;
use DS\Data\Generators\AnyCollectionGenerator;
use DS\Data\Generators\AnyGenerator;
use DS\Data\Generators\IGenerator;
use DS\Data\Generators\StringGenerator;
use DS\Data\Ranges\ArrayRange;
use DS\Data\Ranges\IRange;
use DS\Data\Ranges\NumberOffsetRange;
use PHPUnit\Framework\TestCase;

class ComplexCaseTest extends TestCase
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

    public function testComplexCase()
    {
        $stringLength = 10;
        $stringCount = 5;

        /**
         * @var AnyCollectionGenerator<int, IGenerator<IGenerator>> $collectionGenerator
         */
        $collectionGenerator = new AnyCollectionGenerator(
            new AnyGenerator([
                new ArrayRange([
                    new StringGenerator($this->ranges, $stringLength, [
                        new AnyConverter([
                            new ByteToCharConverter()
                        ])
                    ])
                ])
            ]),
            $stringCount
        );

        /**
         * @var AnyGenerator<int, IConverter<string>> $anyGenerator
         */
        $anyGenerator = new AnyGenerator([
            new ArrayRange([
                new StringRot13Converter(),
                new AlphaToNumberConverter()
            ])
        ]);

        /**
         * @var string[] $values
         */
        $values = [];

        /**
         * @var IGenerator<IGenerator<string>> $value
         */
        foreach ($collectionGenerator->getGenerator() as $value) {
            /**
             * @var IGenerator<string> $generator
             */
            $generator = $value->getValue();
            $newValue = $generator->getValue();

            /**
             * @var IConverter<string> $converter
             */
            $converter = $anyGenerator->getValue();
            $converter->apply($newValue);

            $this->assertInstanceOf(IConverter::class, $converter);

            if ($converter instanceof AlphaToNumberConverter) {
                $this->assertMatchesRegularExpression("/^.+(\/.+)*$/u", $newValue);
            } elseif ($converter instanceof StringRot13Converter) {
                $this->assertMatchesRegularExpression("/^[0-9A-Za-zŽž]{{$stringLength}}$/u", $newValue);
            }

            $values[] = $newValue;
        }

        $this->assertCount($stringCount, $values);
    }
}
