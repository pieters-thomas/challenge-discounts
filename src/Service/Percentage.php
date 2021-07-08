<?php


namespace App\Service;


use PHPUnit\Util\Exception;


class Percentage
{
    private int $percentage;
    private float $discountedRate;

    /**
     * Percentage constructor.
     */
    public function __construct(int $percentOff)
    {
        if($percentOff < 0 && $percentOff > 100)
        {
            throw new Exception("Invalid Percentage Provided");
        }
        $this->percentage = $percentOff;
        $this->discountedRate = (float) (100 - $percentOff)/100;
    }

    public function getPercentage(): int
    {
        return $this->percentage;
    }


    public function getDiscountedRate(): float
    {
        return $this->discountedRate;
    }



}
