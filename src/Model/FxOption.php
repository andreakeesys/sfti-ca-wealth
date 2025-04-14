<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * FX Option financial instrument
 */
class FxOption extends FinancialInstrumentBase
{
    /**
     * @param string $expiryDateTime Expiry date and time
     * @param CurrencyAmount $underlyingAmount Underlying currency amount
     * @param CurrencyAmount $counterAmount Counter currency amount
     * @param CurrencyAmount|null $premium Premium
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
        private readonly string $expiryDateTime,
        private readonly CurrencyAmount $underlyingAmount,
        private readonly CurrencyAmount $counterAmount,
        private readonly ?CurrencyAmount $premium = null,
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
     * Get the expiry date and time
     *
     * @return string
     */
    public function getExpiryDateTime(): string
    {
        return $this->expiryDateTime;
    }

    /**
     * Get the underlying amount
     *
     * @return CurrencyAmount
     */
    public function getUnderlyingAmount(): CurrencyAmount
    {
        return $this->underlyingAmount;
    }

    /**
     * Get the counter amount
     *
     * @return CurrencyAmount
     */
    public function getCounterAmount(): CurrencyAmount
    {
        return $this->counterAmount;
    }

    /**
     * Get the premium
     *
     * @return CurrencyAmount|null
     */
    public function getPremium(): ?CurrencyAmount
    {
        return $this->premium;
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
     * Create an FxOption from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        $identificationList = isset($data['identificationList']) 
            ? self::createIdentificationList($data['identificationList']) 
            : null;
            
        $underlyingAmount = CurrencyAmount::fromArray($data['underlyingAmount']);
        $counterAmount = CurrencyAmount::fromArray($data['counterAmount']);
        $premium = isset($data['premium']) ? CurrencyAmount::fromArray($data['premium']) : null;
            
        return new self(
            $data['type'],
            $data['name'],
            $identificationList,
            $data['cfiCode'] ?? null,
            $data['currencyOfDenomination'] ?? null,
            $data['hasFactor'] ?? null,
            isset($data['factor']) ? (float)$data['factor'] : null,
            $data['additionalDetails'] ?? null,
            $data['expiryDateTime'],
            $underlyingAmount,
            $counterAmount,
            $premium,
            $data['optionType'] ?? null,
            $data['optionStyle'] ?? null
        );
    }
    
    /**
     * Convert the FxOption to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = parent::toArray();
        
        $data['expiryDateTime'] = $this->expiryDateTime;
        $data['underlyingAmount'] = $this->underlyingAmount->toArray();
        $data['counterAmount'] = $this->counterAmount->toArray();
        
        if ($this->premium !== null) {
            $data['premium'] = $this->premium->toArray();
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
