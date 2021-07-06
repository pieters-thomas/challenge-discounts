<?php


namespace App\Model\Discounts;


use App\Entity\Order;
use App\Service\Percentage;
use App\Service\TotalCalculator;
use JetBrains\PhpStorm\Pure;

class CategoryDiscount implements DiscountInterface
{
    private int $category;
    private Percentage $discountRate;
    private TotalCalculator $calculator;

    /**
     * CategoryDiscount constructor.
     */
    #[Pure] public function __construct(int $applyToCategory, int $percentOff)
    {
        $this->category = $applyToCategory;
        $this->discountRate = new Percentage($percentOff);
        $this->calculator = new TotalCalculator();
    }

    public function applyDiscount(Order $order): void
    {
        $discountedItem = $this->cheapestInCategory($order);
        if ($discountedItem !== null)
        {
            foreach ($order->getItems() as $item)
            {
                if ($item === $discountedItem)
                {
                    $discountPrice = $this->discountRate->discountedValue($item->getUnitPrice());
                    $item->setUnitPrice($discountPrice);

                    $newTotal = $this->calculator->calcItemTotal($item);
                    $item->setTotal($newTotal);
                }
            }
        }
    }

    #[Pure] private function cheapestInCategory(Order $order)
    {
        $itemsInCategory = [];

        foreach ($order->getItems() as $item) {
            if ($item->getProduct()->getCategory() === $this->category) {
                $itemsInCategory[] = $item;
            }
        }

        if (count($itemsInCategory) > 1) {
            $cheapest = $itemsInCategory[0];
            foreach ($itemsInCategory as $item) {
                if ($item->getProduct()->getPrice()->getAmount() < $cheapest->getProduct()->getPrice()->getAmount()) {
                    $cheapest = $item;
                }
            }
            return $cheapest;

        }
        return null;
    }
}
