<?php


namespace App\Model;


use App\Entity\Order;
use JetBrains\PhpStorm\Pure;

class RevenueBasedDiscount implements DiscountInterface
{
    private float $revenue;
    private int $discount;

    /**
     * RevenueBasedDiscount constructor.
     */
    public function __construct(float $revenue, int $percentOff)
    {
        $this->revenue = $revenue;
        $this->discount = (100-$percentOff)/100;
    }

    public function applyDiscount(Order $order): void
    {
        if($this->discountAppliesTo($order))
        {

        }
    }

    #[Pure] private function discountAppliesTo(Order $order): bool
    {
        return $order->getCustomer()->getRevenue() >= $this->revenue;
    }
}
