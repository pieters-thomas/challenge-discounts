<?php


namespace App\Entity;


use App\Model\Value;

class Order
{
    private string $id;
    private Customer $customer;
    private array $items;
    private Value $total;

    /**
     * Order constructor.
     * @param string $id
     * @param Customer $customer
     * @param array $items
     * @param Value $total
     */
    public function __construct(string $id, Customer $customer, array $items, Value $total)
    {
        $this->id = $id;
        $this->customer = $customer;
        $this->items = $items;
        $this->total = $total;
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

    /**
     * @return Value
     */
    public function getTotal(): Value
    {
        return $this->total;
    }




}
