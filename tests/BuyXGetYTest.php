<?php


namespace App\Tests;

use App\Model\Discounts\BulkDiscount;
use App\Service\API\OrderApi;
use PHPUnit\Framework\TestCase;

class BuyXGetYTest extends TestCase
{

    public function testDiscount(): void
    {
        $orderApi = new OrderApi();
        $order = $orderApi->fetchOrderById(1);

        $discount = new BulkDiscount(2,5,6);

        $discount->applyDiscount($order);
        self::assertSame(12, $order->getItems()[0]->getQuantity());
 }
}
