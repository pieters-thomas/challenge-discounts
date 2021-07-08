<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Exception;

class Customer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="date")
     */
    private DateTimeImmutable $since;

    /**
     * @ORM\Column(type="float")
     */
    private float $revenue;

    /**
     * Customer constructor.
     * @param array $customerArray
     * @throws Exception
     */
    public function __construct(string $id, string $name, string $since, string $revenue)
    {
        $this->id = (int)$id;
        $this->name = $name;
        $this->since = new DateTimeImmutable($since);
        $this->revenue = (float)$revenue;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSince(): DateTimeImmutable
    {
        return $this->since;
    }

    public function getRevenue(): ?float
    {
        return $this->revenue;
    }

    public function increaseRevenue(float $increase): void
    {
        if($increase > 0)
        {
            $this->revenue += $increase;
        }
    }
}
