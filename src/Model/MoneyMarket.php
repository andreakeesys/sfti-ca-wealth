<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Money Market financial instrument (fixed and callable loans and deposits)
 */
class MoneyMarket extends FinancialInstrumentBase
{
    /**
     * @param CurrencyAmount $principalAmount Principal amount
     * @param InterestRate|null $interestRate Interest rate
     * @param string|null $maturityDate Maturity date
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
        private readonly CurrencyAmount $principalAmount,
        private readonly ?InterestRate $interestRate = null,
        private readonly ?string $maturityDate = null
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
     * Get the principal amount
     *
     * @return CurrencyAmount
     */
    public function getPrincipalAmount(): CurrencyAmount
    {
        return $this->principalAmount;
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
     * Create a MoneyMarket from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        $identificationList = isset($data['identificationList']) 
            ? self::createIdentificationList($data['identificationList']) 
            : null;
            
        $principalAmount = CurrencyAmount::fromArray($data['principalAmount']);
        $interestRate = isset($data['interestRate']) ? InterestRate::fromArray($data['interestRate']) : null;
            
        return new self(
            $data['type'],
            $data['name'],
            $identificationList,
            $data['cfiCode'] ?? null,
            $data['currencyOfDenomination'] ?? null,
            $data['hasFactor'] ?? null,
            isset($data['factor']) ? (float)$data['factor'] : null,
            $data['additionalDetails'] ?? null,
            $principalAmount,
            $interestRate,
            $data['maturityDate'] ?? null
        );
    }
    
    /**
     * Convert the MoneyMarket to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = parent::toArray();
        
        $data['principalAmount'] = $this->principalAmount->toArray();
        
        if ($this->interestRate !== null) {
            $data['interestRate'] = $this->interestRate->toArray();
        }
        
        if ($this->maturityDate !== null) {
            $data['maturityDate'] = $this->maturityDate;
        }
        
        return $data;
    }
}
