<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Bond financial instrument
 */
class Bond extends FinancialInstrumentBase
{
    /**
     * Type identifier for Bond instruments
     */
    public const TYPE = 'bond';
    
    /**
     * @param InterestRate|null $interestRate Interest rate
     * @param string|null $maturityDate Maturity date
     * @param string|null $issueDate Issue date
     * @param Price|null $conversionPrice Conversion price
     * @param float|null $minimumDenomination Minimum denomination
     * @param float|null $minimumIncrement Minimum increment
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
        private readonly ?InterestRate $interestRate = null,
        private readonly ?string $maturityDate = null,
        private readonly ?string $issueDate = null,
        private readonly ?Price $conversionPrice = null,
        private readonly ?float $minimumDenomination = null,
        private readonly ?float $minimumIncrement = null,
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
     * Get the interest rate
     *
     * @return InterestRate|null
     */
    public function getInterestRate(): ?InterestRate
    {
        return $this->interestRate;
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
     * Get the issue date
     *
     * @return string|null
     */
    public function getIssueDate(): ?string
    {
        return $this->issueDate;
    }

    /**
     * Get the conversion price
     *
     * @return Price|null
     */
    public function getConversionPrice(): ?Price
    {
        return $this->conversionPrice;
    }

    /**
     * Get the minimum denomination
     *
     * @return float|null
     */
    public function getMinimumDenomination(): ?float
    {
        return $this->minimumDenomination;
    }

    /**
     * Get the minimum increment
     *
     * @return float|null
     */
    public function getMinimumIncrement(): ?float
    {
        return $this->minimumIncrement;
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
     * Create a Bond from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        $identificationList = isset($data['identificationList']) 
            ? self::createIdentificationList($data['identificationList']) 
            : null;
            
        $interestRate = isset($data['interestRate']) 
            ? InterestRate::fromArray($data['interestRate']) 
            : null;
            
        $conversionPrice = isset($data['conversionPrice']) 
            ? Price::fromArray($data['conversionPrice']) 
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
            $interestRate,
            $data['maturityDate'] ?? null,
            $data['issueDate'] ?? null,
            $conversionPrice,
            isset($data['minimumDenomination']) ? (float)$data['minimumDenomination'] : null,
            isset($data['minimumIncrement']) ? (float)$data['minimumIncrement'] : null,
            $underlyingFinancialInstrument
        );
    }
    
    /**
     * Convert the Bond to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = parent::toArray();
        
        if ($this->interestRate !== null) {
            $data['interestRate'] = $this->interestRate->toArray();
        }
        
        if ($this->maturityDate !== null) {
            $data['maturityDate'] = $this->maturityDate;
        }
        
        if ($this->issueDate !== null) {
            $data['issueDate'] = $this->issueDate;
        }
        
        if ($this->conversionPrice !== null) {
            $data['conversionPrice'] = $this->conversionPrice->toArray();
        }
        
        if ($this->minimumDenomination !== null) {
            $data['minimumDenomination'] = $this->minimumDenomination;
        }
        
        if ($this->minimumIncrement !== null) {
            $data['minimumIncrement'] = $this->minimumIncrement;
        }
        
        if ($this->underlyingFinancialInstrument !== null) {
            $data['underlyingFinancialInstrument'] = $this->underlyingFinancialInstrument->toArray();
        }
        
        return $data;
    }
}
