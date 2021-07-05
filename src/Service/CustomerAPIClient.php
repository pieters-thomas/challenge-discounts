<?php


namespace App\Service;

use App\Entity\Customer;

class CustomerAPIClient extends ApiClient
{
    private const PATH = '/customers.json';

    public function fetchCustomerById(string $customerId): ?Customer
    {
        $customers = $this->apiRequest(self::PATH);
        foreach ($customers as $customer) {
            if ($customer['id'] === $customerId) {
                return new Customer($customer);
            }
        }
        return null;
    }
}
