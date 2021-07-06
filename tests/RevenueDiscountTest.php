<?php


namespace App\Tests;




use App\Model\Discounts\LoyaltyDiscount;
use App\Service\API\OrderApi;
use PHPUnit\Framework\TestCase;

class RevenueDiscountTest extends TestCase
{
    public function dataProviderRevenueDiscount(): array
    {
        return [
            [1,49.90,1000],
            [2,22.455,1000],
        ];
    }

    /**
     * @dataProvider dataProviderRevenueDiscount
     */
    public function testRevenueDiscount(int $number, float $expectedTotal, $revenue): void
    {
        $api = new OrderApi();

        $order = $api->fetchOrderById($number);

        $discount = new LoyaltyDiscount($revenue,10);
        $discount->applyDiscount($order);


        self::assertSame($expectedTotal, $order->getTotal()->getAmount());
}
}
