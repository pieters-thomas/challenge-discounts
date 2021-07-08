<?php

namespace App\Entity;


use App\Model\Value;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Money\Money;


class Product
{
    private string $id;
    private string $description;
    private int $category;
    private Money $price;

    /**
     * Product constructor.
     * @param string $id
     * @param string $description
     * @param int $category
     * @param Money $price
     */
    #[Pure] public function __construct(string $id, string $description, int $category, Money $price)
    {
        $this->id = $id;
        $this->description = $description;
        $this->category = $category;
        $this->price = $price;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCategory(): ?int
    {
        return $this->category;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }

}
