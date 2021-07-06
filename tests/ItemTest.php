<?php


namespace App\Tests;



use App\Entity\Customer;
use App\Entity\Item;
use App\Service\API\OrderApi;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{

    public function dataProviderGetters(): array
    {
        return [
            ['{"id": "1", "customer-id": "1","items": [{"product-id": "B102","quantity": "10","unit-price": "4.99","total": "49.90"}],"total": "49.90"}'],
        ];
    }

    /**
     * @dataProvider dataProviderGetters
     */
    public function testGetters(string $json): void
    {
        $api = new OrderApi();
        $order = $api->fetchOrderById(1);

        $this->assertInstanceOf(Customer::class, $order->getCustomer());
        foreach ($order->getItems() as $item)
        {
            $this->assertInstanceOf(Item::class,$item);
            $this->assertSame("B102",$item->getProduct()->getId());
            $this->assertSame(10,$item->getQuantity());
            $this->assertSame(4.99, $item->getUnitPrice()->getAmount());
            $this->assertSame(49.90, $item->getTotal()->getAmount());
            $this->assertSame([],$item->getDiscountOverview());
            $item->increaseQuantity(10);
            $this->assertSame(20,$item->getQuantity());


        }
        $this->assertSame($order->getTotal()->getAmount(), 49.90);
    }


}
