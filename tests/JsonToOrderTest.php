<?php


namespace App\Tests;




use App\Entity\Order;
use App\Service\JsonToOrderConverter;
use PHPUnit\Framework\TestCase;

class JsonToOrderTest extends TestCase
{
    public function dataProviderItemArray() : array
    {
        $array = [[
                "product-id"=>"B102",
                "quantity"=>"10",
                "unit-price"=>"4.99",
                "total"=>"49.90"]];

        return [
            [$array],
        ];
    }

    /**
     * @dataProvider dataProviderItemArray
     */
    public function testItemArray(array $array): void
    {
        $converter = new JsonToOrderConverter();
        $this->assertIsArray($converter->itemsToItemArray($array));
    }

    public function dataProviderOrderConverter() : array
    {
        $json = file_get_contents('./json/orders/order1.json');
        $json = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        return [
            [$json],
        ];
    }

    /**
     * function has to start with Test
     * @dataProvider dataProviderOrderConverter
     */
    public function testOrderConverter(array $json): void
    {
        $converter = new JsonToOrderConverter();
        $this->assertInstanceOf(Order::class, $converter->convertToOrder($json));
    }
}
