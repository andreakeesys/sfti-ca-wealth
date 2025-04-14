<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Service;

use OpenWealth\CustodyServices\Client\ClientInterface;
use OpenWealth\CustodyServices\Exception\ApiException;
use OpenWealth\CustodyServices\Model\Customer;

/**
 * Service for customer operations
 */
class CustomerService implements CustomerServiceInterface
{
    /**
     * @param ClientInterface $client API client
     */
    public function __construct(
        private readonly ClientInterface $client
    ) {
    }
    
    /**
     * {@inheritdoc}
     */
    public function getCustomers(?string $cursor = null, ?int $limit = null): array
    {
        $queryParams = [];
        
        if ($cursor !== null) {
            $queryParams['cursor'] = $cursor;
        }
        
        if ($limit !== null) {
            $queryParams['limit'] = $limit;
        }
        
        $response = $this->client->get('/customers', $queryParams);
        $data = json_decode((string) $response->getBody(), true);
        
        if (!is_array($data)) {
            throw new ApiException('Invalid response from API');
        }
        
        $customers = [];
        foreach ($data as $customerData) {
            $customers[] = Customer::fromArray($customerData);
        }
        
        return $customers;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getCustomerById(string $customerId): Customer
    {
        $response = $this->client->get("/customers/{$customerId}");
        $data = json_decode((string) $response->getBody(), true);
        
        if (!is_array($data)) {
            throw new ApiException('Invalid response from API');
        }
        
        return Customer::fromArray($data);
    }
}
