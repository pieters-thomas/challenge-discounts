<?php


namespace App\Model\Discounts;


use App\Entity\Order;
use App\Model\Discounts\DiscountInterface;
use App\Model\Value;
use App\Service\Percentage;
use App\Service\TotalCalculator;
use JetBrains\PhpStorm\Pure;
use Money\Currency;
use Money\Money;

class LoyaltyDiscount implements DiscountInterface
{
    private Money $revenue;
    private Percentage $discount;
    private string $description;

    /**
     * LoyaltyDiscount constructor.
     */
    #[Pure] public function __construct(Money $revenue, Percentage $discount)
    {
        $this->revenue = $revenue;
        $this->discount = $discount;
        $this->description = "Loyalty discount of " .$discount->getPercentage()."%";
    }

    public function applyDiscount(Order $order): void
    {
        if ($this->discountAppliesTo($order))
        {
            $order->setTotal($order->getTotal()->multiply( (string) $this->discount->getDiscountedRate()));
            $order->addDiscountDescription($this->description);
        }
    }

    private function discountAppliesTo(Order $order): bool
    {
        return $order->getCustomer()->getRevenue()->greaterThanOrEqual($this->revenue);
    }
}
