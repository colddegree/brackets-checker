<?php

namespace ColdDegree\Tests;

use ColdDegree\ExampleClass;
use PHPUnit\Framework\TestCase;

class ExampleClassTest extends TestCase
{
    public function testDoSomething(): void
    {
        $example = new ExampleClass();
        self::assertSame(4, $example->doSomething());
    }
}
