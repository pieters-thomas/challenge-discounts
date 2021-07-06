<?php


namespace App\Service;


use App\Model\Value;
use JetBrains\PhpStorm\Pure;

class Percentage
{
    private float $percentage;

    /**
     * Percentage constructor.
     */
    public function __construct(float $percentOff)
    {
        $this->percentage = $percentOff;
    }

//    public function getPercentage(): float
//    {
//        return $this->percentage;
//    }

    #[Pure] public function discountedValue(Value $input): Value
    {
       return new Value($input->getAmount() * (100 -  $this->percentage) /100);
    }

//    #[Pure] public function valueSaved(Value $value): Value
//    {
//        return new Value ($value->getAmount() * $this->percentage * 100, $value->getCurrency());
//    }
}
