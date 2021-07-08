<?php


namespace App\Tests;




use App\Model\Discounts\LoyaltyDiscount;
use App\Service\API\OrderApi;
use App\Service\Percentage;
use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;

class RevenueDiscountTest extends TestCase
{
    public function dataProviderRevenueDiscount(): array
    {
        return [
            [1,'4990',new Money(100000,new Currency('€'))],
            [2,'2246',new Money(100000,new Currency('€'))],
        ];
    }

    /**
     * @dataProvider dataProviderRevenueDiscount
     * @throws \JsonException
     */
    public function testRevenueDiscount(int $number, $expectedTotal, $revenue): void
    {
        $api = new OrderApi();

        $order = $api->fetchOrderById($number);

        $discount = new LoyaltyDiscount($revenue,new Percentage(10));
        $discount->applyDiscount($order);


        self::assertSame($expectedTotal, $order->getTotal()->getAmount());
}
}
