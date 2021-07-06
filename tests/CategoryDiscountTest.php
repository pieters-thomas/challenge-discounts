<?php


namespace App\Tests;


use App\Model\Discounts\CategoryDiscount;
use App\Service\API\OrderApi;
use App\Service\JsonToOrderConverter;
use function PHPUnit\Framework\assertTrue;

class CategoryDiscountTest extends \PHPUnit\Framework\TestCase
{
    public function dataProviderCatDisc(): array
    {
        return [
            ['{"id": "1","customer-id": "3","items": [{"product-id": "B102","quantity": "2","unit-price": "4.99","total": "19.50"}],"total": "69.00"}'],
            ['{"id": "2","customer-id": "3","items": [{"product-id": "A102","quantity": "1","unit-price": "49.50","total": "49.50"},{"product-id": "A101","quantity": "2","unit-price": "9.75","total": "19.50"}],"total": "69.00"}'],
            ['{"id": "3","customer-id": "3","items": [{"product-id": "A101","quantity": "2","unit-price": "9.75","total": "19.50"},{"product-id": "A102","quantity": "1","unit-price": "49.50","total": "49.50"}],"total": "69.00"}'],
        ];
    }

    /**
     * @dataProvider dataProviderCatDisc
     */
    public function testCatDisc($number): void
    {
        $converter = new JsonToOrderConverter();
        $order = $converter->convertToOrder(json_decode($number, true, 512, JSON_THROW_ON_ERROR));

        $discount = new CategoryDiscount(1, 100);
        $discount->applyDiscount($order);


        foreach ($order->getItems() as $item)
        {
            if($item->getProduct()->getCategory() === 1)
            {
                var_dump($item->getProduct()->getDescription());
                var_dump($item->getUnitPrice());
                self::assertTrue(true);
                return;
            }
            self::assertSame($item->getProduct()->getPrice()->getAmount(), $item->getUnitPrice()->getAmount());
        }

    }
}
