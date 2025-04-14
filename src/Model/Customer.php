<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Customer model
 */
class Customer
{
    /**
     * @param string $id Unique and unambiguous identification used by the bank for the customer
     * @param string|null $number Contains the customers custody proprietary customer number if available
     * @param string|null $referenceCurrency ISO 4217 currency code
     */
    public function __construct(
        private readonly string $id,
        private readonly ?string $number = null,
        private readonly ?string $referenceCurrency = null
    ) {
    }

    /**
     * Get the customer ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get the customer number
     *
     * @return string|null
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * Get the reference currency
     *
     * @return string|null
     */
    public function getReferenceCurrency(): ?string
    {
        return $this->referenceCurrency;
    }
    
    /**
     * Create a Customer from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['number'] ?? null,
            $data['referenceCurrency'] ?? null
        );
    }
    
    /**
     * Convert the Customer to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [
            'id' => $this->id,
        ];
        
        if ($this->number !== null) {
            $data['number'] = $this->number;
        }
        
        if ($this->referenceCurrency !== null) {
            $data['referenceCurrency'] = $this->referenceCurrency;
        }
        
        return $data;
    }
}
