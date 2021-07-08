<?php


namespace App\Tests;




use App\Service\API\CustomerApi;
use function PHPUnit\Framework\assertEquals;

class ApiClientTest extends \PHPUnit\Framework\TestCase
{
    public function dataProviderApiRequest() : array
    {
        return [
            ['/customers.json'],
            ['/orders/order1.json'],
            ['/products.json'],
            ['/none_existing.json']
        ];
    }

    /**
     * @dataProvider dataProviderApiRequest
     * @throws \JsonException
     */
    public function testApiRequest(string $path): void
    {
        $client = new CustomerApi();

        try {
            $array = $client->apiRequest($path);
            self::assertIsArray($array);
        }
        catch (\Exception $exception){
            assertEquals("json request failed", $exception->getMessage());
        }
    }
}
