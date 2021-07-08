<?php


namespace App\Service;


use App\Entity\Item;
use App\Entity\Order;
use App\Model\Value;
use Doctrine\ORM\Query\AST\Functions\CurrentDateFunction;
use JetBrains\PhpStorm\Pure;
use Money\Currency;
use Money\Money;

class TotalCalculator
{
    public function itemTotal(Item $item): Money
    {
       return new Money( $item->getUnitPrice()->multiply($item->getQuantity())->getAmount(), $item->getTotal()->getCurrency());
    }

    public function orderTotal(Order $order): Money
    {
        $total = 0;
        foreach ($order->getItems() as $item)
        {
            $total += (int) $item->getTotal()->getAmount();
        }
        return new Money($total , $order->getTotal()->getCurrency());
    }
}
