<?php


namespace App\Service\API;


use App\Entity\Order;
use App\Service\JsonToOrderConverter;
use JetBrains\PhpStorm\Pure;

class OrderApi extends ApiClient
{
    private const PATH = '/products.json';
    private JsonToOrderConverter $orderConverter;

    /**
     * OrderApi constructor.
     */
    #[Pure] public function __construct()
    {
        $this->orderConverter = new JsonToOrderConverter();
    }


    /**
     * @throws \JsonException
     */
    public function fetchOrderById(string $targetId): ?Order
    {
        $json = $this->apiRequest('/orders/order'.$targetId.'.json');
        return $this->orderConverter->convertToOrder($json);

    }
}
