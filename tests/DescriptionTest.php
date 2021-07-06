<?php


namespace App\Tests;




use App\Model\DiscountDescription;
use App\Model\Value;

class DescriptionTest extends \PHPUnit\Framework\TestCase
{
    public function testGetters(): void
    {
        $description = new DiscountDescription('Buy 5 Get 6', new Value(2, 'Amount'));
        self::assertSame('Buy 5 Get 6', $description->getDescription());
        self::assertSame(2.0, $description->getValue()->getAmount());
    }

}
