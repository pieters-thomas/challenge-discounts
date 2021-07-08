<?php


namespace App\Tests;


use App\Entity\Product;
use App\Service\API\ProductApi;
use PHPUnit\Framework\TestCase;


class ProductApiTest extends TestCase
{
    public function dataProviderProductById() : array
    {
        return [
            ["A101"],
        ];
    }

    /**
     * function has to start with Test
     * @dataProvider dataProviderProductById
     */
    public function testProductById(string $id): void
    {
        $client = new ProductApi();
        $this->assertInstanceOf(Product::class, $client->fetchProductById($id));
    }

    /**
     * @throws \JsonException
     */
    public function testAllProducts(): void
    {
        $client = new ProductApi();
        $products = $client->fetchAllProducts();
        $allProducts = true;
        foreach ($products as $product)
        {
            if(!$product instanceof Product)
            {
                $allProducts = false;
            }
        }
        $this->assertTrue($allProducts);
    }

}
