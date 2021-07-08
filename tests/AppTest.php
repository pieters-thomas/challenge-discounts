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
            [$api->fetchOrderById(1),4990,'4990'],
            [$api->fetchOrderById(2),2495,'2246'],
            [$api->fetchOrderById(3),6900,'6706'],
        ];
    }

    /**
     * @dataProvider dataProviderApplication
     */
    public function testApplication(Order $order, $rawTotal, $discountTotal): void
    {

        self::assertInstanceOf(Order::class, $order);

        self::assertEquals($order->getTotal()->getAmount(), $rawTotal);

        $discountManager = new DiscountManager();
        $discountManager->applyDiscounts($order);

        self::assertEquals($discountTotal, $order->getTotal()->getAmount());

}
}
