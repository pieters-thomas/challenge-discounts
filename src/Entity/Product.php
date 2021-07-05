<?php

namespace App\Entity;

use App\Model\Value;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;


class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private string $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $description;

    /**
     * @ORM\Column(type="integer")
     */
    private int $category;

    /**
     * @ORM\Column(type="float")
     */
    private Value $price;

    /**
     * Product constructor.
     * @param string $id
     * @param string $description
     * @param int $category
     * @param float $price
     */
    #[Pure] public function __construct(string $id, string $description, int $category, float $price)
    {
        $this->id = $id;
        $this->description = $description;
        $this->category = $category;
        $this->price = new Value($price);
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

    public function getPrice(): Value
    {
        return $this->price;
    }

}
