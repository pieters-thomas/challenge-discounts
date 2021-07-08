<?php


namespace App\Service\API;

use App\Entity\Customer;


class CustomerApi extends ApiClient
{
    private const PATH = '/customers.json';

    /**
     * @throws \JsonException
     * @throws \Exception
     */
    public function fetchCustomerById(string $customerId): ?Customer
    {
        $customers = $this->apiRequest(self::PATH);
        foreach ($customers as $customer) {
            if ($customer['id'] === $customerId) {
                return new Customer(
                    $customer['id'], $customer['name'], $customer['since'], $customer['revenue']);
            }
        }
        return null;
    }
}
