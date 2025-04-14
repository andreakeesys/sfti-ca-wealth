<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Portfolio Information model
 */
class PortfolioInformation
{
    /**
     * @param string|null $identification Unique and unambiguous identification for the portfolio
     * @param string|null $referenceCurrency ISO 4217 currency code
     */
    public function __construct(
        private readonly ?string $identification = null,
        private readonly ?string $referenceCurrency = null
    ) {
    }

    /**
     * Get the portfolio identification
     *
     * @return string|null
     */
    public function getIdentification(): ?string
    {
        return $this->identification;
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
     * Create a PortfolioInformation from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['identification'] ?? null,
            $data['referenceCurrency'] ?? null
        );
    }
    
    /**
     * Convert the PortfolioInformation to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        
        if ($this->identification !== null) {
            $data['identification'] = $this->identification;
        }
        
        if ($this->referenceCurrency !== null) {
            $data['referenceCurrency'] = $this->referenceCurrency;
        }
        
        return $data;
    }
}
