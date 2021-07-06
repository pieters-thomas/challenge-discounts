<?php


namespace App\Tests;




use App\Service\API\CustomerApi;

class ApiClientTest extends \PHPUnit\Framework\TestCase
{
    public function dataProviderApiRequest() : array
    {
        return [
            ['/customers.json'],
            ['/orders/order1.json'],
            ['/products.json'],
        ];
    }

    /**
     * @dataProvider dataProviderApiRequest
     * @throws \JsonException
     */
    public function testApiRequest(string $path): void
    {
        $client = new CustomerApi();
        $this->assertIsArray($client->apiRequest($path));
    }
}
