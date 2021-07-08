<?php


namespace App\Service\API;


use App\Entity\Order;
use App\Service\JsonToOrderConverter;
use JetBrains\PhpStorm\Pure;
use PHPUnit\Exception;

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
     * @throws \Exception
     */
    public function fetchOrderById(string $targetId): ?Order
    {
        try {
            $json = $this->apiRequest('/orders/order'.$targetId.'.json');
            return $this->orderConverter->convertToOrder($json);
        }catch (\Exception)
        {
            throw new \Exception("Order could not be retrieved");
        }



    }
}
