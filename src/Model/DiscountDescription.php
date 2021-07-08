<?php


namespace App\Model;


class DiscountDescription
{
    private string $description;
    private Value $value;

    /**
     * DiscountDescription constructor.
     */
    public function __construct(string $description, Value $value)
    {
        $this->description = $description;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getDescription(): string
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
