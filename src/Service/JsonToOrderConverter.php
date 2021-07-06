<?php


namespace App\Service;


use App\Entity\Customer;
use App\Entity\Item;
use App\Entity\Order;
use App\Model\Value;
use App\Service\API\CustomerApi;
use App\Service\API\ProductApi;
use JetBrains\PhpStorm\Pure;

class JsonToOrderConverter
{
    private ProductApi $productApi;
    private CustomerApi $customerApi;

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
