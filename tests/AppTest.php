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
    public function testApplication(): void
    {
        $api = new OrderApi();
        $order = $api->fetchOrderById(1);

        self::assertInstanceOf(Order::class, $order);

        $discountManager = new DiscountManager();
        $discountManager->applyDiscounts($order);

        self::assertInstanceOf(Order::class, $order);
        //TODO write test that checks the outcomes for each order;
}
}
