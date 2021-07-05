<?php


namespace App\Model;


use App\Entity\Order;

interface DiscountInterface
{
    public function applyDiscount(Order $order):void;
}
