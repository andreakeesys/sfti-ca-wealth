<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Price model
 */
class Price
{
    /**
     * @param PriceType $type Type of price (actual or percentage)
     * @param float $value Signed decimal number
     * @param string|null $currency ISO 4217 currency code
     */
    public function __construct(
        private readonly PriceType $type,
        private readonly float $value,
        private readonly ?string $currency = null
    ) {
    }

    /**
     * Get the price type
     *
     * @return PriceType
     */
    public function getType(): PriceType
    {
        return $this->type;
    }

    /**
     * Get the price value
     *
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * Get the currency
     *
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }
    
    /**
     * Create a Price from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            PriceType::from($data['type']),
            (float)$data['value'],
            $data['currency'] ?? null
        );
    }
    
    /**
     * Convert the Price to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [
            'type' => $this->type->value,
            'value' => $this->value,
        ];
        
        if ($this->currency !== null) {
            $data['currency'] = $this->currency;
        }
        
        return $data;
    }
}
