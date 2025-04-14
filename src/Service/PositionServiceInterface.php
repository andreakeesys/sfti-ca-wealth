<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Service;

use OpenWealth\CustodyServices\Exception\ApiException;
use OpenWealth\CustodyServices\Model\ValuatedPosition;

/**
 * Interface for position service
 */
interface PositionServiceInterface
{
    /**
     * Get positions for a customer
     *
     * @param string $customerId Customer ID
     * @param string $date Date in YYYY-MM-DD format
     * @param bool|null $endOfDayIndicator Filter by end of day indicator
     * @param string|null $cursor Cursor for pagination
     * @param int|null $limit Maximum number of items to return
     * @return array<ValuatedPosition> List of positions
     * @throws ApiException If the API request fails
     */
    public function getCustomerPositions(
        string $customerId,
        string $date,
        ?bool $endOfDayIndicator = null,
        ?string $cursor = null,
        ?int $limit = null
    ): array;
    
    /**
     * Get a position by ID for a customer
     *
     * @param string $customerId Customer ID
     * @param string $positionId Position ID
     * @param string $date Date in YYYY-MM-DD format
     * @param bool|null $endOfDayIndicator Filter by end of day indicator
     * @return ValuatedPosition The position
     * @throws ApiException If the API request fails
     */
    public function getCustomerPositionById(
        string $customerId,
        string $positionId,
        string $date,
        ?bool $endOfDayIndicator = null
    ): ValuatedPosition;
    
    /**
     * Get positions for an account
     *
     * @param string $accountId Account ID
     * @param string $date Date in YYYY-MM-DD format
     * @param bool|null $endOfDayIndicator Filter by end of day indicator
     * @param string|null $cursor Cursor for pagination
     * @param int|null $limit Maximum number of items to return
     * @return array<ValuatedPosition> List of positions
     * @throws ApiException If the API request fails
     */
    public function getAccountPositions(
        string $accountId,
        string $date,
        ?bool $endOfDayIndicator = null,
        ?string $cursor = null,
        ?int $limit = null
    ): array;
    
    /**
     * Get a position by ID for an account
     *
     * @param string $accountId Account ID
     * @param string $positionId Position ID
     * @param string $date Date in YYYY-MM-DD format
     * @param bool|null $endOfDayIndicator Filter by end of day indicator
     * @return ValuatedPosition The position
     * @throws ApiException If the API request fails
     */
    public function getAccountPositionById(
        string $accountId,
        string $positionId,
        string $date,
        ?bool $endOfDayIndicator = null
    ): ValuatedPosition;
}
