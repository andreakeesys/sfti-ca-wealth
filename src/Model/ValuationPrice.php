<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Valuation Price model
 */
class ValuationPrice extends Price
{
    /**
     * @param string $type Type of price (actual or percentage)
     * @param float $value Signed decimal number
     * @param string|null $currency ISO 4217 currency code
     * @param string|null $priceDate Date of the price
     * @param string|null $sourceOfPrice Source of the price
     */
    public function __construct(
        string $type,
        float $value,
        ?string $currency = null,
        private readonly ?string $priceDate = null,
        private readonly ?string $sourceOfPrice = null
    ) {
        parent::__construct($type, $value, $currency);
    }

    /**
     * Get the price date
     *
     * @return string|null
     */
    public function getPriceDate(): ?string
    {
        return $this->priceDate;
    }

    /**
     * Get the source of price
     *
     * @return string|null
     */
    public function getSourceOfPrice(): ?string
    {
        return $this->sourceOfPrice;
    }
    
    /**
     * Create a ValuationPrice from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['type'],
            (float)$data['value'],
            $data['currency'] ?? null,
            $data['priceDate'] ?? null,
            $data['sourceOfPrice'] ?? null
        );
    }
    
    /**
     * Convert the ValuationPrice to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = parent::toArray();
        
        if ($this->priceDate !== null) {
            $data['priceDate'] = $this->priceDate;
        }
        
        if ($this->sourceOfPrice !== null) {
            $data['sourceOfPrice'] = $this->sourceOfPrice;
        }
        
        return $data;
    }
}
