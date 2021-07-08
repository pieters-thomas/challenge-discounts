<?php


namespace App\Service;

use App\Entity\Order;
use App\Model\Discounts\BulkDiscount;
use App\Model\Discounts\CategoryDiscount;
use App\Model\Discounts\DiscountInterface;
use App\Model\Discounts\LoyaltyDiscount;
use Money\Currency;
use Money\Money;

class DiscountManager
{

    /**
     * @var DiscountInterface[]
     */
    private array $preTotalCalcDiscounts;
    private array $postTotalCalcDiscounts;
    private TotalCalculator $calculator;

    /**
     * DiscountManager constructor.
     */
    public function __construct()
    {
        $this->calculator = new TotalCalculator();
        $this->preTotalCalcDiscounts = [
            new CategoryDiscount(1, new Percentage(10)),
        ];

        $this->postTotalCalcDiscounts = [
            new LoyaltyDiscount(new Money(100000, new Currency($_SERVER['EUR'])), new Percentage(10)),
            new BulkDiscount(2, 5, 6),
        ];
    }

    public function applyDiscounts(Order $order): void
    {

        $this->applyPreCalcDiscounts($order);

        $order->setTotal($this->calculator->orderTotal($order));

        $this->applyPostCalcDiscounts($order);
    }

    private function applyPreCalcDiscounts(Order $order): void
    {
        foreach ($this->preTotalCalcDiscounts as $discount) {
            $discount->applyDiscount($order);
        }
    }

    private function applyPostCalcDiscounts(Order $order): void
    {
        foreach ($this->postTotalCalcDiscounts as $discount) {
            $discount->applyDiscount($order);
        }
    }
}
