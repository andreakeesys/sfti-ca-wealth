<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Service;

use OpenWealth\CustodyServices\Client\ClientInterface;
use OpenWealth\CustodyServices\Exception\ApiException;
use OpenWealth\CustodyServices\Model\Account;

/**
 * Service for account operations
 */
class AccountService implements AccountServiceInterface
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
    public function getCustomerAccounts(string $customerId, ?string $cursor = null, ?int $limit = null): array
    {
        $queryParams = [];
        
        if ($cursor !== null) {
            $queryParams['cursor'] = $cursor;
        }
        
        if ($limit !== null) {
            $queryParams['limit'] = $limit;
        }
        
        $response = $this->client->get("/customers/{$customerId}/accounts", $queryParams);
        $data = json_decode((string) $response->getBody(), true);
        
        if (!is_array($data)) {
            throw new ApiException('Invalid response from API');
        }
        
        $accounts = [];
        foreach ($data as $accountData) {
            $accounts[] = Account::fromArray($accountData);
        }
        
        return $accounts;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getCustomerAccountById(string $customerId, string $accountId): Account
    {
        $response = $this->client->get("/customers/{$customerId}/accounts/{$accountId}");
        $data = json_decode((string) $response->getBody(), true);
        
        if (!is_array($data)) {
            throw new ApiException('Invalid response from API');
        }
        
        return Account::fromArray($data);
    }
}
