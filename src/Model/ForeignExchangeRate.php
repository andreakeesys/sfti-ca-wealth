<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Foreign Exchange Rate model
 */
class ForeignExchangeRate
{
    /**
     * @param float $value Current rate as decimal
     * @param string $sourceCurrency Source currency
     * @param string $targetCurrency Target currency
     */
    public function __construct(
        private readonly float $value,
        private readonly string $sourceCurrency,
        private readonly string $targetCurrency
    ) {
    }

    /**
     * Get the rate value
     *
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * Get the source currency
     *
     * @return string
     */
    public function getSourceCurrency(): string
    {
        return $this->sourceCurrency;
    }

    /**
     * Get the target currency
     *
     * @return string
     */
    public function getTargetCurrency(): string
    {
        return $this->targetCurrency;
    }
    
    /**
     * Create a ForeignExchangeRate from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            (float)$data['value'],
            $data['sourceCurrency'],
            $data['targetCurrency']
        );
    }
    
    /**
     * Convert the ForeignExchangeRate to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'value' => $this->value,
            'sourceCurrency' => $this->sourceCurrency,
            'targetCurrency' => $this->targetCurrency,
        ];
    }
}
