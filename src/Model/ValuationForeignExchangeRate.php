<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Valuation Foreign Exchange Rate model
 */
class ValuationForeignExchangeRate extends ForeignExchangeRate
{
    /**
     * @param float $value Current rate as decimal
     * @param string $sourceCurrency Source currency
     * @param string $targetCurrency Target currency
     * @param string|null $rateDate Date of rate
     * @param string|null $sourceOfRate Source of the rate
     */
    public function __construct(
        float $value,
        string $sourceCurrency,
        string $targetCurrency,
        private readonly ?string $rateDate = null,
        private readonly ?string $sourceOfRate = null
    ) {
        parent::__construct($value, $sourceCurrency, $targetCurrency);
    }

    /**
     * Get the rate date
     *
     * @return string|null
     */
    public function getRateDate(): ?string
    {
        return $this->rateDate;
    }

    /**
     * Get the source of rate
     *
     * @return string|null
     */
    public function getSourceOfRate(): ?string
    {
        return $this->sourceOfRate;
    }
    
    /**
     * Create a ValuationForeignExchangeRate from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            (float)$data['value'],
            $data['sourceCurrency'],
            $data['targetCurrency'],
            $data['rateDate'] ?? null,
            $data['sourceOfRate'] ?? null
        );
    }
    
    /**
     * Convert the ValuationForeignExchangeRate to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = parent::toArray();
        
        if ($this->rateDate !== null) {
            $data['rateDate'] = $this->rateDate;
        }
        
        if ($this->sourceOfRate !== null) {
            $data['sourceOfRate'] = $this->sourceOfRate;
        }
        
        return $data;
    }
}
