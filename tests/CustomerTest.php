<?php

namespace App\Tests;


use App\Service\API\CustomerApi;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{

    public function dataProviderGetters() : array
    {
        return [
            ["1", (int) "1","Coca Cola", new DateTimeImmutable("2014-06-28"), "49212"],
        ];
    }

    /**
     * function has to start with Test
     * @dataProvider dataProviderGetters
     * @throws \JsonException
     */
    public function testGetters($target, $id, $name, $since, $revenue): void
    {
        $client = new CustomerApi();
        $customer = $client->fetchCustomerById($target);

        $this->assertSame($customer->getId(), $id);
        $this->assertSame($customer->getName(), $name);
        $this->assertSame($customer->getSince()->getTimestamp(), $since->getTimestamp());
        $this->assertSame($customer->getRevenue()->getAmount(), $revenue);
    }

}
