<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Place Of Trade model
 */
class PlaceOfTrade
{
    /**
     * @param string|null $marketIdentificationCode Market Identifier Code
     * @param string|null $marketDescription Description of the market
     */
    public function __construct(
        private readonly ?string $marketIdentificationCode = null,
        private readonly ?string $marketDescription = null
    ) {
    }

    /**
     * Get the market identification code
     *
     * @return string|null
     */
    public function getMarketIdentificationCode(): ?string
    {
        return $this->marketIdentificationCode;
    }

    /**
     * Get the market description
     *
     * @return string|null
     */
    public function getMarketDescription(): ?string
    {
        return $this->marketDescription;
    }
    
    /**
     * Create a PlaceOfTrade from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['marketIdentificationCode'] ?? null,
            $data['marketDescription'] ?? null
        );
    }
    
    /**
     * Convert the PlaceOfTrade to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        
        if ($this->marketIdentificationCode !== null) {
            $data['marketIdentificationCode'] = $this->marketIdentificationCode;
        }
        
        if ($this->marketDescription !== null) {
            $data['marketDescription'] = $this->marketDescription;
        }
        
        return $data;
    }
}
