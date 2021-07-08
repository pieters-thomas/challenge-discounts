<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Money\Money;

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
    private Money $revenue;

    /**
     * Customer constructor.
     * @param int $id
     * @param string $name
     * @param DateTimeImmutable $since
     * @param Money $revenue
     */
    public function __construct(int $id, string $name, DateTimeImmutable $since, Money $revenue)
    {
        $this->id = $id;
        $this->name = $name;
        $this->since = $since;
        $this->revenue = $revenue;
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

    public function getRevenue(): Money
    {
        return $this->revenue;
    }
}
