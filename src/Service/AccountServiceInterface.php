<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Service;

use OpenWealth\CustodyServices\Exception\ApiException;
use OpenWealth\CustodyServices\Model\Account;

/**
 * Interface for account service
 */
interface AccountServiceInterface
{
    /**
     * Get accounts for a customer
     *
     * @param string $customerId Customer ID
     * @param string|null $cursor Cursor for pagination
     * @param int|null $limit Maximum number of items to return
     * @return array<Account> List of accounts
     * @throws ApiException If the API request fails
     */
    public function getCustomerAccounts(string $customerId, ?string $cursor = null, ?int $limit = null): array;
    
    /**
     * Get an account by ID for a customer
     *
     * @param string $customerId Customer ID
     * @param string $accountId Account ID
     * @return Account The account
     * @throws ApiException If the API request fails
     */
    public function getCustomerAccountById(string $customerId, string $accountId): Account;
}
