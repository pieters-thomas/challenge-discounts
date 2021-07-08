<?php


namespace App\Entity;


use App\Model\Value;
use Money\Money;

class Order
{
    private string $id;
    private Customer $customer;
    /**
     * @var Item[]
     */
    private array $items;

    private Money $total;

    private array $discountOverview;

    /**
     * Order constructor.
     * @param string $id
     * @param Customer $customer
     * @param array $items
     * @param Money $total
     */
    public function __construct(string $id, Customer $customer, array $items, Money $total)
    {
        $this->id = $id;
        $this->customer = $customer;
        $this->items = $items;
        $this->total = $total;
        $this->discountOverview = [];
    }

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotal(): Money
    {
        return $this->total;
    }

    public function setTotal(Money $newValue): void
    {
        $this->total = $newValue;
    }

    public function getDiscountOverview(): array
    {
        return $this->discountOverview;
    }

    public function addDiscountDescription(string $description):void
    {
        $this->discountOverview[] = $description;
    }
}
