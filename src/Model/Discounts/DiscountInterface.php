<?php


namespace App\Model\Discounts;


use App\Entity\Order;

interface DiscountInterface
{
    public function applyDiscount(Order $order):void;
}
