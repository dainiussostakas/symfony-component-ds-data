<?php

declare(strict_types=1);

namespace DS\Generator;

use PHPUnit\Framework\TestCase;

class GeneratorTest extends TestCase
{
    /** Ranges [from, length] of unicode code points */
    const RANGES = [
        [0x30, 10], // [0-9]
        [0x41, 26], // [A-Z]
        [0x61, 26], // [a-z]
        [0x17d, 1], // [Ž]
        [0x17e, 1] // [ž]
    ];

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
        $stringCollectionGenerator = new StringCollectionGenerator(self::RANGES, 40, 20);

        foreach ($stringCollectionGenerator->getGenerator() as $value) {
            var_dump($value);
        }

        $a = 5;

//        $generator = new StringGenerator(self::RANGES, 256);
//
//        $this->assertMatchesRegularExpression("/^[0-9A-Za-zŽž]{256}$/u", $generator->getValue());
    }
}