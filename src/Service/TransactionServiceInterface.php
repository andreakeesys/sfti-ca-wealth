<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Service;

use OpenWealth\CustodyServices\Exception\ApiException;
use OpenWealth\CustodyServices\Model\Transaction;

/**
 * Interface for transaction service
 */
interface TransactionServiceInterface
{
    /**
     * Get transactions for a customer
     *
     * @param string $customerId Customer ID
     * @param string|null $date Date in YYYY-MM-DD format
     * @param bool|null $endOfDayIndicator Filter by end of day indicator
     * @param string|null $cursor Cursor for pagination
     * @param int|null $limit Maximum number of items to return
     * @return array<Transaction> List of transactions
     * @throws ApiException If the API request fails
     */
    public function getCustomerTransactions(
        string $customerId,
        ?string $date = null,
        ?bool $endOfDayIndicator = null,
        ?string $cursor = null,
        ?int $limit = null
    ): array;
    
    /**
     * Get a transaction by ID for a customer
     *
     * @param string $customerId Customer ID
     * @param string $transactionId Transaction ID
     * @return Transaction The transaction
     * @throws ApiException If the API request fails
     */
    public function getCustomerTransactionById(string $customerId, string $transactionId): Transaction;
}
