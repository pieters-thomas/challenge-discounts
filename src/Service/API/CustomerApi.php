<?php


namespace App\Service\API;

use App\Entity\Customer;
use Exception;
use Money\Currency;
use Money\Money;


class CustomerApi extends ApiClient
{
    private const PATH = '/customers.json';

    /**
     * @throws Exception
     */
    public function fetchCustomerById(string $customerId): ?Customer
    {
        try {
            $customers = $this->apiRequest(self::PATH);
        }catch (Exception)
        {
            throw new Exception("customer not found");
        }

        foreach ($customers as $customer) {
            if ($customer['id'] === $customerId) {
                return new Customer(
                   (int) $customer['id'],
                   (string) $customer['name'],
                   new \DateTimeImmutable((string)$customer['since']),
                   new Money(((float) $customer['revenue']) * 100, new Currency('€'))
                );
            }
        }
        return null;
    }
}
