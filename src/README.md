# OpenWealth Custody Services PHP SDK

This SDK provides a PHP client for the OpenWealth Custody Services API.

## Requirements

- PHP 8.4 or higher
- Composer

## Installation

```bash
composer require openwealth/custody-services-sdk
```

## Usage

```php
<?php

require 'vendor/autoload.php';

use OpenWealth\CustodyServices\CustodyServicesClient;

// Create a client
$client = new CustodyServicesClient(
    'https://api.openwealth.ch',
    [
        'Authorization' => 'Bearer YOUR_API_TOKEN'
    ]
);

// Set a correlation ID for request tracing
$client->setCorrelationId('your-correlation-id');

// Get all customers
$customers = $client->customers()->getCustomers();

// Get a specific customer
$customer = $client->customers()->getCustomerById('customer-id');

// Get accounts for a customer
$accounts = $client->accounts()->getCustomerAccounts('customer-id');

// Get positions for a customer on a specific date
$positions = $client->positions()->getCustomerPositions(
    'customer-id',
    '2023-01-01',
    true // Only end-of-day positions
);

// Get transactions for a customer
$transactions = $client->transactions()->getCustomerTransactions('customer-id');
```

## Error Handling

The SDK throws exceptions for API errors:

```php
<?php

use OpenWealth\CustodyServices\Exception\ApiException;
use OpenWealth\CustodyServices\Exception\AuthenticationException;
use OpenWealth\CustodyServices\Exception\NotFoundException;
use OpenWealth\CustodyServices\Exception\ValidationException;

try {
    $customer = $client->customers()->getCustomerById('non-existent-id');
} catch (NotFoundException $e) {
    // Handle 404 error
    echo "Customer not found: " . $e->getMessage();
} catch (AuthenticationException $e) {
    // Handle authentication errors (401, 403)
    echo "Authentication error: " . $e->getMessage();
} catch (ValidationException $e) {
    // Handle validation errors (400)
    echo "Validation error: " . $e->getMessage();
} catch (ApiException $e) {
    // Handle other API errors
    echo "API error: " . $e->getMessage();
}
```

## Pagination

The API supports cursor-based pagination:

```php
<?php

// Get the first page of customers
$customers = $client->customers()->getCustomers(null, 10);

// Get the next page using the cursor from the response headers
$nextCursor = /* Get cursor from response headers */;
$nextPage = $client->customers()->getCustomers($nextCursor, 10);
```

## License

This SDK is licensed under the Apache License 2.0.
