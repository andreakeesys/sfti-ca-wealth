<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Valuation model
 */
class Valuation
{
    /**
     * @param CurrencyAmount $valueInPositionCurrency Value in position currency
     * @param CurrencyAmount|null $valueInReferenceCurrency Value in reference currency
     * @param string|null $valuationDate Date when the position was valuated
     */
    public function __construct(
        private readonly CurrencyAmount $valueInPositionCurrency,
        private readonly ?CurrencyAmount $valueInReferenceCurrency = null,
        private readonly ?string $valuationDate = null
    ) {
    }

    /**
     * Get the value in position currency
     *
     * @return CurrencyAmount
     */
    public function getValueInPositionCurrency(): CurrencyAmount
    {
        return $this->valueInPositionCurrency;
    }

    /**
     * Get the value in reference currency
     *
     * @return CurrencyAmount|null
     */
    public function getValueInReferenceCurrency(): ?CurrencyAmount
    {
        return $this->valueInReferenceCurrency;
    }

    /**
     * Get the valuation date
     *
     * @return string|null
     */
    public function getValuationDate(): ?string
    {
        return $this->valuationDate;
    }
    
    /**
     * Create a Valuation from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        $valueInPositionCurrency = CurrencyAmount::fromArray($data['valueInPositionCurrency']);
        $valueInReferenceCurrency = isset($data['valueInReferenceCurrency']) 
            ? CurrencyAmount::fromArray($data['valueInReferenceCurrency']) 
            : null;
            
        return new self(
            $valueInPositionCurrency,
            $valueInReferenceCurrency,
            $data['valuationDate'] ?? null
        );
    }
    
    /**
     * Convert the Valuation to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [
            'valueInPositionCurrency' => $this->valueInPositionCurrency->toArray(),
        ];
        
        if ($this->valueInReferenceCurrency !== null) {
            $data['valueInReferenceCurrency'] = $this->valueInReferenceCurrency->toArray();
        }
        
        if ($this->valuationDate !== null) {
            $data['valuationDate'] = $this->valuationDate;
        }
        
        return $data;
    }
}
