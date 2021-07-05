<?php


namespace App\Service;


use App\Entity\Customer;
use App\Entity\Item;
use App\Entity\Order;
use App\Model\Value;
use JetBrains\PhpStorm\Pure;

class JsonToOrderConverter
{
    private ProductApiClient $productApi;
    private CustomerAPIClient $customerApi;

    /**
     * JsonToOrderConverter constructor.
     */
    #[Pure] public function __construct()
    {
        $this->productApi = new ProductApiClient();
        $this->customerApi = new CustomerAPIClient();
    }

    /**
     * @throws \JsonException
     */
    public function convertToOrder(string $json): Order
    {
        $order = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        $id = $order['id'];
        $customer = $this->customerIdToCustomer($order['customer-id']) ;
        $items = $this->itemsToItemArray($order['items']);
        $total = new Value($order['total']);

        return new Order($id, $customer, $items, $total);

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
            $product = $this->productApi->fetchProductById($item["product-id"]);
            $unitPrice = new Value($item["unit-price"]);
            $total = new Value($item["total"]);

            $itemArray[] = new Item($product, (int) $item["quantity"],$unitPrice,$total);
        }
        return $itemArray;
    }
}
