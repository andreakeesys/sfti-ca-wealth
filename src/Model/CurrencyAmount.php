<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Currency Amount model
 */
class CurrencyAmount
{
    /**
     * @param float $amount Signed amount
     * @param string $currency ISO 4217 currency code
     */
    public function __construct(
        private readonly float $amount,
        private readonly string $currency
    ) {
    }

    /**
     * Get the amount
     *
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Get the currency
     *
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }
    
    /**
     * Create a CurrencyAmount from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            (float)$data['amount'],
            $data['currency']
        );
    }
    
    /**
     * Convert the CurrencyAmount to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'amount' => $this->amount,
            'currency' => $this->currency,
        ];
    }
}
