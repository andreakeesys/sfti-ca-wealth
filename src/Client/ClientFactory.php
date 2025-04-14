<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Client;

use GuzzleHttp\Client as GuzzleHttpClient;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Factory for creating API clients
 */
class ClientFactory
{
    /**
     * Create a new API client
     *
     * @param string $baseUrl The base URL for the API
     * @param array<string, string> $headers Default headers to include with every request
     * @param LoggerInterface|null $logger Optional logger for API requests
     * @return ClientInterface The configured API client
     */
    public static function create(
        string $baseUrl,
        array $headers = [],
        ?LoggerInterface $logger = null
    ): ClientInterface {
        $httpClient = new GuzzleHttpClient([
            'base_uri' => $baseUrl,
            'headers' => array_merge([
                'Accept' => 'application/json',
            ], $headers),
        ]);
        
        return new GuzzleClient($httpClient, $logger ?? new NullLogger());
    }
}
