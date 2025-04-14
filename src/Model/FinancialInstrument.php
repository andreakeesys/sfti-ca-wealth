<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Financial Instrument interface
 */
interface FinancialInstrument
{
    /**
     * Get the instrument type
     *
     * @return string
     */
    public function getType(): string;
    
    /**
     * Get the instrument name
     *
     * @return string
     */
    public function getName(): string;
    
    /**
     * Get the identification list
     *
     * @return array<FinancialInstrumentIdentification>|null
     */
    public function getIdentificationList(): ?array;
    
    /**
     * Get the CFI code
     *
     * @return string|null
     */
    public function getCfiCode(): ?string;
    
    /**
     * Get the currency of denomination
     *
     * @return string|null
     */
    public function getCurrencyOfDenomination(): ?string;
    
    /**
     * Check if the instrument has a factor
     *
     * @return bool|null
     */
    public function getHasFactor(): ?bool;
    
    /**
     * Get the factor
     *
     * @return float|null
     */
    public function getFactor(): ?float;
    
    /**
     * Get additional details
     *
     * @return string|null
     */
    public function getAdditionalDetails(): ?string;
    
    /**
     * Convert the financial instrument to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array;
}
