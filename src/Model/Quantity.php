<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Quantity model
 */
class Quantity
{
    /**
     * @param QuantityType $type Type of the amount (unit, faceAmount, amortisedValue, digitalTokenUnit)
     * @param float $value Signed decimal number
     */
    public function __construct(
        private readonly QuantityType $type,
        private readonly float $value
    ) {
    }

    /**
     * Get the quantity type
     *
     * @return QuantityType
     */
    public function getType(): QuantityType
    {
        return $this->type;
    }

    /**
     * Get the quantity value
     *
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }
    
    /**
     * Create a Quantity from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            QuantityType::from($data['type']),
            (float)$data['value']
        );
    }
    
    /**
     * Convert the Quantity to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type->value,
            'value' => $this->value,
        ];
    }
}
