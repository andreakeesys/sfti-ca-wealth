<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

use InvalidArgumentException;

/**
 * Factory for creating financial instruments
 */
class FinancialInstrumentFactory
{
    /**
     * Create a financial instrument from an array of data
     *
     * @param array<string, mixed> $data
     * @return FinancialInstrument
     * @throws InvalidArgumentException If the instrument type is not supported
     */
    public static function createFromArray(array $data): FinancialInstrument
    {
        return match ($data['type']) {
            'cash' => Cash::fromArray($data),
            // Add other instrument types as needed
            default => throw new InvalidArgumentException("Unsupported financial instrument type: {$data['type']}"),
        };
    }
}
