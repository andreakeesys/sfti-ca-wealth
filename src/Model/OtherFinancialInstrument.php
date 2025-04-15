<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Other financial instrument
 */
class OtherFinancialInstrument extends FinancialInstrumentBase
{
    /**
     * Type identifier for Other financial instruments
     */
    public const TYPE = 'other';
    
    /**
     * @param FinancialInstrument|null $underlyingFinancialInstrument Underlying financial instrument
     */
    public function __construct(
        string $type,
        string $name,
        ?array $identificationList = null,
        ?string $cfiCode = null,
        ?string $currencyOfDenomination = null,
        ?bool $hasFactor = null,
        ?float $factor = null,
        ?string $additionalDetails = null,
        private readonly ?FinancialInstrument $underlyingFinancialInstrument = null
    ) {
        parent::__construct(
            $type,
            $name,
            $identificationList,
            $cfiCode,
            $currencyOfDenomination,
            $hasFactor,
            $factor,
            $additionalDetails
        );
    }

    /**
     * Get the underlying financial instrument
     *
     * @return FinancialInstrument|null
     */
    public function getUnderlyingFinancialInstrument(): ?FinancialInstrument
    {
        return $this->underlyingFinancialInstrument;
    }

    /**
     * Create an OtherFinancialInstrument from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        $identificationList = isset($data['identificationList']) 
            ? self::createIdentificationList($data['identificationList']) 
            : null;
            
        $underlyingFinancialInstrument = isset($data['underlyingFinancialInstrument']) 
            ? FinancialInstrumentFactory::createFromArray($data['underlyingFinancialInstrument']) 
            : null;
            
        return new self(
            $data['type'],
            $data['name'],
            $identificationList,
            $data['cfiCode'] ?? null,
            $data['currencyOfDenomination'] ?? null,
            $data['hasFactor'] ?? null,
            isset($data['factor']) ? (float)$data['factor'] : null,
            $data['additionalDetails'] ?? null,
            $underlyingFinancialInstrument
        );
    }
    
    /**
     * Convert the OtherFinancialInstrument to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = parent::toArray();
        
        if ($this->underlyingFinancialInstrument !== null) {
            $data['underlyingFinancialInstrument'] = $this->underlyingFinancialInstrument->toArray();
        }
        
        return $data;
    }
}
