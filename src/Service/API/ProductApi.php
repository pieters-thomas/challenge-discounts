<?php


namespace App\Service\API;

use App\Entity\Product;
use Money\Currency;
use Money\Money;


class ProductApi extends ApiClient
{
    private const PATH = '/products.json';
    private const EUR = '€';
    /**
     * @throws \JsonException
     */
    public function fetchAllProducts(): array
    {

        $productsRaw = $this->apiRequest(self::PATH);
        $products = [];

        foreach ($productsRaw as $product) {
            $products[] = new Product(
                (int) $product['id'],
                $product['description'],
                (int) $product['category'],
                new Money( ((float) $product['price']) * 100, new Currency(self::EUR)) );
        }
        return $products;
    }

    /**
     * @throws \JsonException
     */
    public function fetchProductById(string $targetId): ?Product
    {
        $products = $this->apiRequest(self::PATH);
        $targetProduct = null;
        foreach ($products as $product)
        {
            if( $product['id'] === $targetId)
            {
                $targetProduct = new Product(
                    (string) $product['id'],
                    $product['description'],
                    (int) $product['category'],
                    new Money(((float) $product['price']) * 100, new Currency(self::EUR)),
                );
            }
        }
        return $targetProduct;
    }
}
