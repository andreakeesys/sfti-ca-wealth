<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Future financial instrument
 */
class Future extends FinancialInstrumentBase
{
    /**
     * @param FinancialInstrument $underlyingFinancialInstrument Underlying financial instrument
     * @param string|null $expiryDate Expiry date
     * @param float|null $contractSize Contract size
     * @param Price|null $exercisePrice Exercise price
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
        private readonly ?float $contractSize = null,
        private readonly ?Price $exercisePrice = null
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
     * Get the contract size
     *
     * @return float|null
     */
    public function getContractSize(): ?float
    {
        return $this->contractSize;
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
     * Create a Future from an array of data
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
            isset($data['contractSize']) ? (float)$data['contractSize'] : null,
            $exercisePrice
        );
    }
    
    /**
     * Convert the Future to an array
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
        
        if ($this->contractSize !== null) {
            $data['contractSize'] = $this->contractSize;
        }
        
        if ($this->exercisePrice !== null) {
            $data['exercisePrice'] = $this->exercisePrice->toArray();
        }
        
        return $data;
    }
}
