<?php


namespace App\Tests;


use App\Entity\Order;
use App\Service\API\OrderApi;
use App\Service\DiscountManager;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    /**
     * @throws \JsonException
     */
    public function dataProviderApplication(): array
    {
        $api = new OrderApi();

        return [
            [$api->fetchOrderById(1),49.90,49.90],
            [$api->fetchOrderById(2),24.95,22.46],
            [$api->fetchOrderById(3),69.00,67.05],
        ];
    }

    /**
     * @dataProvider dataProviderApplication
     */
    public function testApplication(Order $order, $rawTotal, $discountTotal): void
    {

        self::assertInstanceOf(Order::class, $order);

        self::assertEquals(number_format($order->getTotal()->getAmount(),2), $rawTotal);

        $discountManager = new DiscountManager();
        $discountManager->applyDiscounts($order);

        self::assertEquals(number_format($order->getTotal()->getAmount(),2) , $discountTotal);

}
}
