<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Service;

use OpenWealth\CustodyServices\Exception\ApiException;
use OpenWealth\CustodyServices\Model\Customer;

/**
 * Interface for customer service
 */
interface CustomerServiceInterface
{
    /**
     * Get all customers
     *
     * @param string|null $cursor Cursor for pagination
     * @param int|null $limit Maximum number of items to return
     * @return array<Customer> List of customers
     * @throws ApiException If the API request fails
     */
    public function getCustomers(?string $cursor = null, ?int $limit = null): array;
    
    /**
     * Get a customer by ID
     *
     * @param string $customerId Customer ID
     * @return Customer The customer
     * @throws ApiException If the API request fails
     */
    public function getCustomerById(string $customerId): Customer;
}
