<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Service;

use OpenWealth\CustodyServices\Client\ClientInterface;
use OpenWealth\CustodyServices\Exception\ApiException;
use OpenWealth\CustodyServices\Model\ValuatedPosition;

/**
 * Service for position operations
 */
class PositionService implements PositionServiceInterface
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
    public function getCustomerPositions(
        string $customerId,
        string $date,
        ?bool $endOfDayIndicator = null,
        ?string $cursor = null,
        ?int $limit = null
    ): array {
        $queryParams = [
            'date' => $date,
        ];
        
        if ($endOfDayIndicator !== null) {
            $queryParams['end_of_day_indicator'] = $endOfDayIndicator ? 'true' : 'false';
        }
        
        if ($cursor !== null) {
            $queryParams['cursor'] = $cursor;
        }
        
        if ($limit !== null) {
            $queryParams['limit'] = $limit;
        }
        
        $response = $this->client->get("/customers/{$customerId}/positions", $queryParams);
        $data = json_decode((string) $response->getBody(), true);
        
        if (!is_array($data)) {
            throw new ApiException('Invalid response from API');
        }
        
        $positions = [];
        foreach ($data as $positionData) {
            $positions[] = ValuatedPosition::fromArray($positionData);
        }
        
        return $positions;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getCustomerPositionById(
        string $customerId,
        string $positionId,
        string $date,
        ?bool $endOfDayIndicator = null
    ): ValuatedPosition {
        $queryParams = [
            'date' => $date,
        ];
        
        if ($endOfDayIndicator !== null) {
            $queryParams['end_of_day_indicator'] = $endOfDayIndicator ? 'true' : 'false';
        }
        
        $response = $this->client->get("/customers/{$customerId}/positions/{$positionId}", $queryParams);
        $data = json_decode((string) $response->getBody(), true);
        
        if (!is_array($data)) {
            throw new ApiException('Invalid response from API');
        }
        
        return ValuatedPosition::fromArray($data);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getAccountPositions(
        string $accountId,
        string $date,
        ?bool $endOfDayIndicator = null,
        ?string $cursor = null,
        ?int $limit = null
    ): array {
        $queryParams = [
            'date' => $date,
        ];
        
        if ($endOfDayIndicator !== null) {
            $queryParams['end_of_day_indicator'] = $endOfDayIndicator ? 'true' : 'false';
        }
        
        if ($cursor !== null) {
            $queryParams['cursor'] = $cursor;
        }
        
        if ($limit !== null) {
            $queryParams['limit'] = $limit;
        }
        
        $response = $this->client->get("/accounts/{$accountId}/positions", $queryParams);
        $data = json_decode((string) $response->getBody(), true);
        
        if (!is_array($data)) {
            throw new ApiException('Invalid response from API');
        }
        
        $positions = [];
        foreach ($data as $positionData) {
            $positions[] = ValuatedPosition::fromArray($positionData);
        }
        
        return $positions;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getAccountPositionById(
        string $accountId,
        string $positionId,
        string $date,
        ?bool $endOfDayIndicator = null
    ): ValuatedPosition {
        $queryParams = [
            'date' => $date,
        ];
        
        if ($endOfDayIndicator !== null) {
            $queryParams['end_of_day_indicator'] = $endOfDayIndicator ? 'true' : 'false';
        }
        
        $response = $this->client->get("/accounts/{$accountId}/positions/{$positionId}", $queryParams);
        $data = json_decode((string) $response->getBody(), true);
        
        if (!is_array($data)) {
            throw new ApiException('Invalid response from API');
        }
        
        return ValuatedPosition::fromArray($data);
    }
}
