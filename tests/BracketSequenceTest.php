<?php

namespace ColdDegree\Tests;

use ColdDegree\BracketSequence;
use PHPUnit\Framework\TestCase;

class BracketSequenceTest extends TestCase
{
    /**
     * @test
     * @dataProvider invalidInputProvider
     * @param string $input
     */
    public function initWithInvalidChars(string $input): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new BracketSequence($input);
    }

    /**
     * @test
     * @dataProvider invalidSequenceProvider
     * @dataProvider validSequenceProvider
     * @param string $input
     */
    public function initWithOnlyValidChars(string $input): void
    {
        $bs = new BracketSequence($input);
        self::assertInstanceOf(BracketSequence::class, $bs);
    }

    public function invalidInputProvider(): \Generator
    {
        yield [''];
        yield ['(0)'];
    }

    public function validSequenceProvider(): \Generator
    {
        yield ['()'];
        yield ['[]'];
        yield ['{}'];
        yield ['([]{})'];
        yield ['([]{}{}{}()[]())([])[{(){}[]}]{}'];
    }

    public function invalidSequenceProvider(): \Generator
    {
        yield ['([]})({}'];
        yield ['('];
        yield [')'];
        yield ['[]{'];
        yield ['(((((((((('];
        yield [')))'];
    }

    /**
     * @test
     * @dataProvider validSequenceProvider
     * @param string $input
     */
    public function isValid(string $input): void
    {
        $bs = new BracketSequence($input);
        self::assertTrue($bs->isValid());
    }

    /**
     * @test
     * @dataProvider invalidSequenceProvider
     * @param string $input
     */
    public function isNotValid(string $input): void
    {
        $bs = new BracketSequence($input);
        self::assertFalse($bs->isValid());
    }
}
