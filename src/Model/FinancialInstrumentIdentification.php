<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Financial Instrument Identification model
 */
class FinancialInstrumentIdentification
{
    /**
     * @param string $identifier Instrument identification
     * @param string $type Type of the instrument ID
     */
    public function __construct(
        private readonly string $identifier,
        private readonly string $type
    ) {
    }

    /**
     * Get the identifier
     *
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * Get the type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
    
    /**
     * Create a FinancialInstrumentIdentification from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['identifier'],
            $data['type']
        );
    }
    
    /**
     * Convert the FinancialInstrumentIdentification to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'identifier' => $this->identifier,
            'type' => $this->type,
        ];
    }
}
