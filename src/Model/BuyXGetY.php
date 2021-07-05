<?php


namespace App\Model;


use App\Entity\Item;
use App\Entity\Order;
use JetBrains\PhpStorm\Pure;

class BuyXGetY implements DiscountInterface
{
    private int $productCategory;
    private int $buyX;
    private int $getY;
    private string $description;


    /**
     * BuyXGetY constructor.
     */
    public function __construct(int $productCategory, int $buyX, int $getY)
    {
        $this->productCategory = $productCategory;
        $this->buyX = $buyX;
        $this->getY = $getY;
        $this->description = "Buy ". $this->buyX ." get ".$this->getY;
    }

    public function applyDiscount(Order $order): void
    {
        foreach ($order->getItems() as $item)
        {
            if($this->discountAppliesTo($item))
            {
                $bonus = ($this->getY-$this->buyX) * floor($item->getQuantity()/$this->buyX);
                $item->increaseQuantity($bonus);
                $item->addDiscountOverview(new DiscountDescription($this->description,new Value($bonus, "pcs")));
            }
        }
    }

    #[Pure] private function discountAppliesTo(Item $item): bool
    {
        return $item->getProduct()->getCategory() === $this->productCategory;
    }
}
