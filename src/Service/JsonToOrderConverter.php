<?php


namespace App\Service;


use App\Entity\Customer;
use App\Entity\Item;
use App\Entity\Order;
use App\Model\Value;
use App\Service\API\CustomerApi;
use App\Service\API\ProductApi;
use JetBrains\PhpStorm\Pure;
use Money\Currency;
use Money\Money;

class JsonToOrderConverter
{
    private ProductApi $productApi;
    private CustomerApi $customerApi;
    private const EUR = '€';

    /**
     * JsonToOrderConverter constructor.
     */
    #[Pure] public function __construct()
    {
        $this->productApi = new ProductApi();
        $this->customerApi = new CustomerApi();
    }

    /**
     * @throws \JsonException
     */
    public function convertToOrder(array $order): Order
    {
        return new Order(
            $order['id'],
            $this->customerIdToCustomer($order['customer-id']),
            $this->itemsToItemArray($order['items']),
            $this->stringToMoney($order['total'])
        );
    }

    public function customerIdToCustomer(string $customerId): Customer
    {
        return $this->customerApi->fetchCustomerById($customerId);
    }

    public function itemsToItemArray(array $items): array
    {
        $itemArray = [];
        foreach ($items as $item)
        {
            $itemArray[] = new Item(
                $this->productApi->fetchProductById($item["product-id"]),
                (int) $item["quantity"],
                $this->stringToMoney($item["unit-price"]),
                $this->stringToMoney($item["total"]),
            );
        }
        return $itemArray;
    }

    public function stringToMoney(string $moneyString): Money
    {
        $amount = str_ireplace(".", "",$moneyString);
        return new Money($amount, new Currency(self::EUR));
    }
}
