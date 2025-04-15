<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Credit Default Swap financial instrument
 */
class CreditDefaultSwap extends FinancialInstrumentBase
{
    /**
     * Type identifier for Credit Default Swap instruments
     */
    public const TYPE = 'creditDefaultSwap';
    
    /**
     * @param CurrencyAmount $notionalAmount Notional amount
     * @param string|null $maturityDate Maturity date
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
        private readonly CurrencyAmount $notionalAmount,
        private readonly ?string $maturityDate = null,
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
     * Get the notional amount
     *
     * @return CurrencyAmount
     */
    public function getNotionalAmount(): CurrencyAmount
    {
        return $this->notionalAmount;
    }

    /**
     * Get the maturity date
     *
     * @return string|null
     */
    public function getMaturityDate(): ?string
    {
        return $this->maturityDate;
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
     * Create a CreditDefaultSwap from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        $identificationList = isset($data['identificationList']) 
            ? self::createIdentificationList($data['identificationList']) 
            : null;
            
        $notionalAmount = CurrencyAmount::fromArray($data['notionalAmount']);
        
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
            $notionalAmount,
            $data['maturityDate'] ?? null,
            $underlyingFinancialInstrument
        );
    }
    
    /**
     * Convert the CreditDefaultSwap to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = parent::toArray();
        
        $data['notionalAmount'] = $this->notionalAmount->toArray();
        
        if ($this->maturityDate !== null) {
            $data['maturityDate'] = $this->maturityDate;
        }
        
        if ($this->underlyingFinancialInstrument !== null) {
            $data['underlyingFinancialInstrument'] = $this->underlyingFinancialInstrument->toArray();
        }
        
        return $data;
    }
}
