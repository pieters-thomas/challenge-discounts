<?php


namespace App\Entity;


use App\Model\DiscountDescription;
use App\Model\Discounts\DiscountInterface;
use App\Model\Value;
use Money\Money;

class Item
{
    private Product $product;
    private int $quantity;
    private int $freeQuantity = 0;
    private Money $unitPrice;
    private Money $total;
    private array $discountOverview = [];

    /**
     * Item constructor.
     * @param Product $product
     * @param int $quantity
     * @param Money $unitPrice
     * @param Money $total
     */
    public function __construct(Product $product, int $quantity, Money $unitPrice, Money $total)
    {
        $this->product = $product;
        $this->quantity = $quantity;
        $this->unitPrice = $unitPrice;
        $this->total = $total;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getFreeQuantity(): int
    {
        return $this->freeQuantity;
    }

    public function setFreeQuantity(int $freeQuantity): void
    {
        $this->freeQuantity = $freeQuantity;
    }

    public function increaseQuantity(int $increaseBy): void
    {
        if ($increaseBy > 0) {
            $this->quantity += $increaseBy;
        }
    }

    public function getUnitPrice(): Money
    {
        return $this->unitPrice;
    }


    public function setUnitPrice(Money $unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }



    /**
     * @return array
     */
    public function getDiscountOverview(): array
    {
        return $this->discountOverview;
    }

    public function addDiscountDescription(string $description): void
    {
        $this->discountOverview[] = $description;
    }


    public function getTotal(): Money
    {
        return $this->total;
    }


    public function setTotal(Money $total): void
    {
        $this->total = $total;
    }



}
