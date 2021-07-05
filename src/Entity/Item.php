<?php


namespace App\Entity;


use App\Model\DiscountDescription;
use App\Model\DiscountInterface;
use App\Model\Value;

class Item
{
    private Product $product;
    private int $quantity;
    private Value $unitPrice;
    private Value $total;
    private array $discountOverview = [];

    /**
     * Item constructor.
     * @param Product $product
     * @param int $quantity
     * @param Value $unitPrice
     * @param Value $total
     */
    public function __construct(Product $product, int $quantity, Value $unitPrice, Value $total)
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

    public function increaseQuantity(int $increaseBy): void
    {
        if ($increaseBy > 0) {
            $this->quantity += $increaseBy;
        }
    }

    /**
     * @return Value
     */
    public function getUnitPrice(): Value
    {
        return $this->unitPrice;
    }

    /**
     * @return array
     */
    public function getDiscountOverview(): array
    {
        return $this->discountOverview;
    }

    public function addDiscountOverview(DiscountDescription $description): void
    {
        $this->discountOverview[] = $description;
    }

    /**
     * @return Value
     */
    public function getTotal(): Value
    {
        return $this->total;
    }


}
