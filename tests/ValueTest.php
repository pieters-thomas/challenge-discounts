<?php


namespace App\Tests;


use App\Model\Value;
use PHPUnit\Framework\TestCase;

class ValueTest extends TestCase
{
    public function testGetters(): void
    {
        $value = new Value(1000);

        self::assertSame($value->getAmount(), 1000.00);
        self::assertSame($value->getCurrency(), "€");
    }

    public function testToString(): void
    {
        $value = new Value(10);
        self::assertIsString('what a rush'. $value);
    }
}
