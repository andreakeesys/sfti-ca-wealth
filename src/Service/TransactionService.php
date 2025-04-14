<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Service;

use OpenWealth\CustodyServices\Client\ClientInterface;
use OpenWealth\CustodyServices\Exception\ApiException;
use OpenWealth\CustodyServices\Model\Transaction;

/**
 * Service for transaction operations
 */
class TransactionService implements TransactionServiceInterface
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
    public function getCustomerTransactions(
        string $customerId,
        ?string $date = null,
        ?bool $endOfDayIndicator = null,
        ?string $cursor = null,
        ?int $limit = null
    ): array {
        $queryParams = [];
        
        if ($date !== null) {
            $queryParams['date'] = $date;
        }
        
        if ($endOfDayIndicator !== null) {
            $queryParams['end_of_day_indicator'] = $endOfDayIndicator ? 'true' : 'false';
        }
        
        if ($cursor !== null) {
            $queryParams['cursor'] = $cursor;
        }
        
        if ($limit !== null) {
            $queryParams['limit'] = $limit;
        }
        
        $response = $this->client->get("/customers/{$customerId}/transactions", $queryParams);
        $data = json_decode((string) $response->getBody(), true);
        
        if (!is_array($data)) {
            throw new ApiException('Invalid response from API');
        }
        
        $transactions = [];
        foreach ($data as $transactionData) {
            $transactions[] = Transaction::fromArray($transactionData);
        }
        
        return $transactions;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getCustomerTransactionById(string $customerId, string $transactionId): Transaction
    {
        $response = $this->client->get("/customers/{$customerId}/transactions/{$transactionId}");
        $data = json_decode((string) $response->getBody(), true);
        
        if (!is_array($data)) {
            throw new ApiException('Invalid response from API');
        }
        
        return Transaction::fromArray($data);
    }
}
