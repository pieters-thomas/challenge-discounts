<?php


namespace App\Model;


class DiscountDescription
{
    private $description;
    private Value $value;

    /**
     * DiscountDescription constructor.
     */
    public function __construct($description, Value $value)
    {
        $this->description = $description;
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return Value
     */
    public function getValue(): Value
    {
        return $this->value;
    }


}
