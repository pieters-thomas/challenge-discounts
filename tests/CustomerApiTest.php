<?php


namespace App\Tests;



use App\Entity\Customer;
use App\Service\API\CustomerApi;
use PHPUnit\Framework\TestCase;

class CustomerApiTest extends TestCase
{
    public function dataProviderCustomerById() : array
    {
        return [
            [1],
            [999],
        ];
    }

    /**
     * function has to start with Test
     * @dataProvider dataProviderCustomerById
     */
    public function testCustomerById(int $id): void
    {
        $client = new CustomerApi();
        $this->assertTrue($client->fetchCustomerById($id) instanceof Customer || $client->fetchCustomerById($id) === null);
    }

}
