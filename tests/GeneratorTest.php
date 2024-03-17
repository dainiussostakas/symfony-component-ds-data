<?php

declare(strict_types=1);

namespace DS\Generator;

use DS\Generator\Converters\AlphaToNumberConverter;
use DS\Generator\Converters\ByteToCharConverter;
use DS\Generator\Converters\IConverter;
use DS\Generator\Converters\RandomConverter;
use DS\Generator\Converters\StringRot13Converter;
use DS\Generator\Generators\AnyGenerator;
use DS\Generator\Generators\AnyCollectionGenerator;
use DS\Generator\Generators\IGenerator;
use DS\Generator\Generators\StringGenerator;
use DS\Generator\Ranges\ArrayRange;
use DS\Generator\Ranges\IRange;
use DS\Generator\Ranges\NumberOffsetRange;
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

//    public function testWhenLengthIsTen()
//    {
//        $generator = new StringGenerator(self::RANGES, 10);
//
//        $this->assertCount(10, iterator_to_array($generator->getGenerator()));
//    }
//
//    public function testWhenLengthIsMinusOne()
//    {
//        $generator = new StringGenerator(self::RANGES, -1);
//
//        $this->assertCount(0, iterator_to_array($generator->getGenerator()));
//    }
//
//    public function testWhenLengthIsZero()
//    {
//        $generator = new StringGenerator(self::RANGES, 0);
//
//        $this->assertCount(0, iterator_to_array($generator->getGenerator()));
//    }

    public function testMatchPattern()
    {
        $randomConverter = new RandomConverter([
            new ByteToCharConverter(),
//            new ByteReplaceConverter()
        ]);

//        $anyGenerator = new AnyGenerator([
//            new ArrayRange([
//                new ByteToCharConverter(),
////                new ByteReplaceConverter()
//            ]),
//            new NumberOffsetRange(5, 0)
//        ]);
//
//        $value1 = $anyGenerator->getValue();
//
//        var_dump($value1);

        /**
         * @var AnyCollectionGenerator<int, IGenerator> $stringCollectionGenerator
         */
        $stringCollectionGenerator = new AnyCollectionGenerator(
            new AnyGenerator([
                new ArrayRange([
                    new StringGenerator($this->ranges, 10, [
                        new RandomConverter([
                            new ByteToCharConverter()
                        ])
                    ])
                ])
            ]),
            5
        );

        /**
         * @var AnyGenerator<int, IConverter> $anyGenerator
         */
        $anyGenerator = new AnyGenerator([
            new ArrayRange([
                new StringRot13Converter(),
                new AlphaToNumberConverter()
            ])
        ]);

        foreach ($stringCollectionGenerator->getGenerator() as $value) {
            $originalValue = $value->getValue();
            $newValue = $originalValue;
            $anyGenerator->getValue()->apply($newValue);

            var_dump($originalValue . ': ' . $newValue);
        }

        $generator = new StringGenerator($this->ranges, 256);

        $this->assertMatchesRegularExpression("/^[0-9A-Za-zŽž]{256}$/u", $generator->getValue());
    }
}
