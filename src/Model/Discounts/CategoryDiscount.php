<?php


namespace App\Model\Discounts;


use App\Entity\Order;
use App\Service\Percentage;
use App\Service\TotalCalculator;
use JetBrains\PhpStorm\Pure;

class CategoryDiscount implements DiscountInterface
{
    private int $category;
    private Percentage $discount;
    private TotalCalculator $calculator;
    private string $description;

    /**
     * CategoryDiscount constructor.
     */
    #[Pure] public function __construct(int $applyToCategory, Percentage $discount)
    {
        $this->category = $applyToCategory;
        $this->discount = $discount;
        $this->calculator = new TotalCalculator();
        $this->description = "Category Discount ".$discount->getPercentage()."%";
    }

    public function applyDiscount(Order $order): void
    {
        $discountedItem = $this->cheapestInCategory($order);
        if ($discountedItem !== null)
        {
            foreach ($order->getItems() as $item)
            {
                if ($item !== $discountedItem)
                {
                   continue;
                }
                $discountPrice = $item->getUnitPrice()->multiply( (string) $this->discount->getDiscountedRate());
                $item->setUnitPrice($discountPrice);

                $newTotal = $this->calculator->itemTotal($item);
                $item->setTotal($newTotal);
                $item->addDiscountDescription($this->description);
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
