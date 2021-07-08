<?php


namespace App\Model;


use App\Service\Percentage;
use JetBrains\PhpStorm\Pure;

class Value
{
    private float $amount;
    private string $currency;

    /**
     * Value constructor.
     * @param float $amount
     * @param string $currency
     */
    #[Pure] public function __construct(float $amount, string $currency = '€')
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    #[Pure] public function __toString(): string
    {
        return $this->currency." ".number_format($this->amount, 2);
    }

    /**
     * @return float
     */
    #[Pure] public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */

    #[Pure] public function getCurrency(): string
    {
        return $this->currency;
    }

    #[Pure] public function reduceByPercentage(Percentage $percent): Value
    {
        return new Value($this->getAmount() * (100 -  $percent->getPercentage()) /100) ;
    }

}
