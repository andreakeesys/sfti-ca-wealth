<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Option financial instrument
 */
class Option extends FinancialInstrumentBase
{
    /**
     * @param FinancialInstrument $underlyingFinancialInstrument Underlying financial instrument
     * @param string|null $expiryDate Expiry date
     * @param Price|null $exercisePrice Exercise price
     * @param float|null $contractSize Contract size
     * @param string|null $optionType Option type (call/put)
     * @param string|null $optionStyle Option style (american/european/etc)
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
        private readonly FinancialInstrument $underlyingFinancialInstrument,
        private readonly ?string $expiryDate = null,
        private readonly ?Price $exercisePrice = null,
        private readonly ?float $contractSize = null,
        private readonly ?string $optionType = null,
        private readonly ?string $optionStyle = null
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
     * @return FinancialInstrument
     */
    public function getUnderlyingFinancialInstrument(): FinancialInstrument
    {
        return $this->underlyingFinancialInstrument;
    }

    /**
     * Get the expiry date
     *
     * @return string|null
     */
    public function getExpiryDate(): ?string
    {
        return $this->expiryDate;
    }

    /**
     * Get the exercise price
     *
     * @return Price|null
     */
    public function getExercisePrice(): ?Price
    {
        return $this->exercisePrice;
    }

    /**
     * Get the contract size
     *
     * @return float|null
     */
    public function getContractSize(): ?float
    {
        return $this->contractSize;
    }

    /**
     * Get the option type
     *
     * @return string|null
     */
    public function getOptionType(): ?string
    {
        return $this->optionType;
    }

    /**
     * Get the option style
     *
     * @return string|null
     */
    public function getOptionStyle(): ?string
    {
        return $this->optionStyle;
    }

    /**
     * Create an Option from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        $identificationList = isset($data['identificationList']) 
            ? self::createIdentificationList($data['identificationList']) 
            : null;
            
        $underlyingFinancialInstrument = FinancialInstrumentFactory::createFromArray($data['underlyingFinancialInstrument']);
        
        $exercisePrice = isset($data['exercisePrice']) 
            ? Price::fromArray($data['exercisePrice']) 
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
            $underlyingFinancialInstrument,
            $data['expiryDate'] ?? null,
            $exercisePrice,
            isset($data['contractSize']) ? (float)$data['contractSize'] : null,
            $data['optionType'] ?? null,
            $data['optionStyle'] ?? null
        );
    }
    
    /**
     * Convert the Option to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = parent::toArray();
        
        $data['underlyingFinancialInstrument'] = $this->underlyingFinancialInstrument->toArray();
        
        if ($this->expiryDate !== null) {
            $data['expiryDate'] = $this->expiryDate;
        }
        
        if ($this->exercisePrice !== null) {
            $data['exercisePrice'] = $this->exercisePrice->toArray();
        }
        
        if ($this->contractSize !== null) {
            $data['contractSize'] = $this->contractSize;
        }
        
        if ($this->optionType !== null) {
            $data['optionType'] = $this->optionType;
        }
        
        if ($this->optionStyle !== null) {
            $data['optionStyle'] = $this->optionStyle;
        }
        
        return $data;
    }
}
