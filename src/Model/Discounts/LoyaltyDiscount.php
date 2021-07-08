<?php


namespace App\Model\Discounts;


use App\Entity\Order;
use App\Model\Discounts\DiscountInterface;
use App\Model\Value;
use App\Service\Percentage;
use JetBrains\PhpStorm\Pure;

class LoyaltyDiscount implements DiscountInterface
{
    private float $revenue;
    private Percentage $discount;
    private string $description;

    /**
     * LoyaltyDiscount constructor.
     */
    #[Pure] public function __construct(float $revenue, int $percentOff)
    {
        $this->revenue = $revenue;
        $this->discount = new Percentage($percentOff);
        $this->description = "Loyalty discount of " .$percentOff."%";
    }

    public function applyDiscount(Order $order): void
    {
        if ($this->discountAppliesTo($order))
        {
            $order->setTotal($order->getTotal()->reduceByPercentage($this->discount));
            $order->addDiscountDescription($this->description);
        }
    }

    #[Pure] private function discountAppliesTo(Order $order): bool
    {
        return $order->getCustomer()->getRevenue() >= $this->revenue;
    }
}
