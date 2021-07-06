<?php


namespace App\Service;


use App\Entity\Item;
use App\Entity\Order;
use App\Model\Value;
use JetBrains\PhpStorm\Pure;

class TotalCalculator
{
    #[Pure] public function calcItemTotal(Item $item): Value
    {
       return new Value($item->getQuantity() * $item->getUnitPrice()->getAmount());
    }

    #[Pure] public function calcOrderTotal(Order $order): Value
    {
        $total = 0;
        foreach ($order->getItems() as $item)
        {
            $total += $item->getTotal()->getAmount();
        }
        return new Value($total);
    }
}
