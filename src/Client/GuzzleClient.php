<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Client;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\GuzzleException;
use OpenWealth\CustodyServices\Exception\ApiException;
use OpenWealth\CustodyServices\Exception\AuthenticationException;
use OpenWealth\CustodyServices\Exception\NotFoundException;
use OpenWealth\CustodyServices\Exception\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Guzzle implementation of the API client
 */
class GuzzleClient implements ClientInterface
{
    private string $correlationId;
    
    /**
     * @param GuzzleHttpClient $httpClient The Guzzle HTTP client
     * @param LoggerInterface $logger Logger for API requests
     */
    public function __construct(
        private readonly GuzzleHttpClient $httpClient,
        private readonly LoggerInterface $logger = new NullLogger()
    ) {
        $this->correlationId = bin2hex(random_bytes(16));
    }
    
    /**
     * {@inheritdoc}
     */
    public function get(string $endpoint, array $queryParams = [], array $headers = []): ResponseInterface
    {
        $headers = array_merge([
            'X-Correlation-ID' => $this->correlationId,
            'Accept' => 'application/json',
        ], $headers);
        
        try {
            $this->logger->debug('Sending GET request', [
                'endpoint' => $endpoint,
                'queryParams' => $queryParams,
                'correlationId' => $this->correlationId
            ]);
            
            $response = $this->httpClient->request('GET', $endpoint, [
                'headers' => $headers,
                'query' => $queryParams,
            ]);
            
            $this->logger->debug('Received response', [
                'statusCode' => $response->getStatusCode(),
                'correlationId' => $this->correlationId
            ]);
            
            return $response;
        } catch (GuzzleException $e) {
            $this->handleRequestException($e);
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function setCorrelationId(string $correlationId): self
    {
        $this->correlationId = $correlationId;
        return $this;
    }
    
    /**
     * Handle exceptions from the HTTP client
     *
     * @param GuzzleException $exception The exception from Guzzle
     * @throws ApiException The appropriate API exception
     */
    private function handleRequestException(GuzzleException $exception): never
    {
        $response = method_exists($exception, 'getResponse') ? $exception->getResponse() : null;
        $statusCode = $response?->getStatusCode() ?? 500;
        
        $this->logger->error('API request failed', [
            'statusCode' => $statusCode,
            'message' => $exception->getMessage(),
            'correlationId' => $this->correlationId
        ]);
        
        $errorData = [];
        if ($response) {
            $body = (string) $response->getBody();
            $errorData = json_decode($body, true) ?? [];
        }
        
        $message = $errorData['detail'] ?? $exception->getMessage();
        
        throw match ($statusCode) {
            400 => new ValidationException($message, $statusCode, $exception),
            401, 403 => new AuthenticationException($message, $statusCode, $exception),
            404 => new NotFoundException($message, $statusCode, $exception),
            default => new ApiException($message, $statusCode, $exception),
        };
    }
}
