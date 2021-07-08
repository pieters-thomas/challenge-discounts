<?php


namespace App\Model\Discounts;


use App\Entity\Item;
use App\Entity\Order;
use App\Model\DiscountDescription;
use App\Model\Value;
use JetBrains\PhpStorm\Pure;

class BulkDiscount implements DiscountInterface
{
    private int $productCategory;
    private int $buyX;
    private int $getY;
    private string $description;


    /**
     * BulkDiscount constructor.
     */
    public function __construct(int $productCategory, int $buyX, int $getY)
    {
        $this->productCategory = $productCategory;
        $this->buyX = $buyX;
        $this->getY = $getY;
        $this->description = "Buy " . $this->buyX . " get " . $this->getY;
    }

    public function applyDiscount(Order $order): void
    {
        foreach ($order->getItems() as $item) {
            if (!$this->discountAppliesTo($item)) {
                continue;
            }

            $bonus = ($this->getY - $this->buyX) * floor($item->getQuantity() / $this->buyX);
            $item->setFreeQuantity($bonus);
            $item->addDiscountDescription($this->description);
        }
    }

    #[Pure] private function discountAppliesTo(Item $item): bool
    {
        return $item->getProduct()->getCategory() === $this->productCategory;
    }
}
