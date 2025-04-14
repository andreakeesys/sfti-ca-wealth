<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Client;

use OpenWealth\CustodyServices\Exception\ApiException;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface for API client implementations
 */
interface ClientInterface
{
    /**
     * Send a GET request to the API
     *
     * @param string $endpoint The API endpoint
     * @param array<string, mixed> $queryParams Optional query parameters
     * @param array<string, string> $headers Optional additional headers
     * @return ResponseInterface The API response
     * @throws ApiException If the API request fails
     */
    public function get(string $endpoint, array $queryParams = [], array $headers = []): ResponseInterface;
    
    /**
     * Set the correlation ID for requests
     *
     * @param string $correlationId The correlation ID
     * @return self
     */
    public function setCorrelationId(string $correlationId): self;
}
