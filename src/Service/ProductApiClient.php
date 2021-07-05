<?php


namespace App\Service;


use App\Entity\Customer;
use App\Entity\Product;

class ProductApiClient extends ApiClient
{
    private const PATH = '/products.json';

    public function fetchAllProducts(): array
    {
        $productsRaw = $this->apiRequest(self::PATH);
        $products = [];

        foreach ($productsRaw as $product) {
            $products[] = new Product((int) $product['id'], $product['description'], (int) $product['category'], (float) $product['price']);
        }
        return $products;
    }

    public function fetchProductById(string $targetId): ?Product
    {
        $products = $this->apiRequest(self::PATH);
        $targetProduct = null;
        foreach ($products as $product)
        {
            if( $product['id'] === $targetId)
            {
                $targetProduct = new Product( (string) $product['id'], $product['description'], (int) $product['category'], (float) $product['price']);
            }
        }
        return $targetProduct;
    }
}
