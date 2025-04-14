<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices;

use OpenWealth\CustodyServices\Client\ClientFactory;
use OpenWealth\CustodyServices\Client\ClientInterface;
use OpenWealth\CustodyServices\Service\AccountService;
use OpenWealth\CustodyServices\Service\AccountServiceInterface;
use OpenWealth\CustodyServices\Service\CustomerService;
use OpenWealth\CustodyServices\Service\CustomerServiceInterface;
use OpenWealth\CustodyServices\Service\PositionService;
use OpenWealth\CustodyServices\Service\PositionServiceInterface;
use OpenWealth\CustodyServices\Service\TransactionService;
use OpenWealth\CustodyServices\Service\TransactionServiceInterface;
use Psr\Log\LoggerInterface;

/**
 * Main client for the Custody Services API
 */
class CustodyServicesClient
{
    private ClientInterface $client;
    private CustomerServiceInterface $customerService;
    private AccountServiceInterface $accountService;
    private PositionServiceInterface $positionService;
    private TransactionServiceInterface $transactionService;
    
    /**
     * @param string $baseUrl The base URL for the API
     * @param array<string, string> $headers Default headers to include with every request
     * @param LoggerInterface|null $logger Optional logger for API requests
     */
    public function __construct(
        string $baseUrl,
        array $headers = [],
        ?LoggerInterface $logger = null
    ) {
        $this->client = ClientFactory::create($baseUrl, $headers, $logger);
        $this->customerService = new CustomerService($this->client);
        $this->accountService = new AccountService($this->client);
        $this->positionService = new PositionService($this->client);
        $this->transactionService = new TransactionService($this->client);
    }
    
    /**
     * Set the correlation ID for API requests
     *
     * @param string $correlationId The correlation ID
     * @return self
     */
    public function setCorrelationId(string $correlationId): self
    {
        $this->client->setCorrelationId($correlationId);
        return $this;
    }
    
    /**
     * Get the customer service
     *
     * @return CustomerServiceInterface
     */
    public function customers(): CustomerServiceInterface
    {
        return $this->customerService;
    }
    
    /**
     * Get the account service
     *
     * @return AccountServiceInterface
     */
    public function accounts(): AccountServiceInterface
    {
        return $this->accountService;
    }
    
    /**
     * Get the position service
     *
     * @return PositionServiceInterface
     */
    public function positions(): PositionServiceInterface
    {
        return $this->positionService;
    }
    
    /**
     * Get the transaction service
     *
     * @return TransactionServiceInterface
     */
    public function transactions(): TransactionServiceInterface
    {
        return $this->transactionService;
    }
}
