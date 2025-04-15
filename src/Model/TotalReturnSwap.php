<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Total Return Swap financial instrument
 */
class TotalReturnSwap extends FinancialInstrumentBase
{
    /**
     * Type identifier for Total Return Swap instruments
     */
    public const TYPE = 'totalReturnSwap';
    
    /**
     * @param CurrencyAmount $notionalAmount Notional amount
     * @param FinancialInstrument $underlyingFinancialInstrument Underlying financial instrument
     * @param InterestRate|null $interestRatePaid Interest rate paid
     * @param InterestRate|null $interestRateReceived Interest rate received
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
        private readonly CurrencyAmount $notionalAmount,
        private readonly FinancialInstrument $underlyingFinancialInstrument,
        private readonly ?InterestRate $interestRatePaid = null,
        private readonly ?InterestRate $interestRateReceived = null,
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
     * Get the notional amount
     *
     * @return CurrencyAmount
     */
    public function getNotionalAmount(): CurrencyAmount
    {
        return $this->notionalAmount;
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
     * Get the interest rate paid
     *
     * @return InterestRate|null
     */
    public function getInterestRatePaid(): ?InterestRate
    {
        return $this->interestRatePaid;
    }

    /**
     * Get the interest rate received
     *
     * @return InterestRate|null
     */
    public function getInterestRateReceived(): ?InterestRate
    {
        return $this->interestRateReceived;
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
     * Create a TotalReturnSwap from an array of data
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
        $underlyingFinancialInstrument = FinancialInstrumentFactory::createFromArray($data['underlyingFinancialInstrument']);
        
        $interestRatePaid = isset($data['interestRatePaid']) 
            ? InterestRate::fromArray($data['interestRatePaid']) 
            : null;
            
        $interestRateReceived = isset($data['interestRateReceived']) 
            ? InterestRate::fromArray($data['interestRateReceived']) 
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
            $underlyingFinancialInstrument,
            $interestRatePaid,
            $interestRateReceived,
            $data['maturityDate'] ?? null
        );
    }
    
    /**
     * Convert the TotalReturnSwap to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = parent::toArray();
        
        $data['notionalAmount'] = $this->notionalAmount->toArray();
        $data['underlyingFinancialInstrument'] = $this->underlyingFinancialInstrument->toArray();
        
        if ($this->interestRatePaid !== null) {
            $data['interestRatePaid'] = $this->interestRatePaid->toArray();
        }
        
        if ($this->interestRateReceived !== null) {
            $data['interestRateReceived'] = $this->interestRateReceived->toArray();
        }
        
        if ($this->maturityDate !== null) {
            $data['maturityDate'] = $this->maturityDate;
        }
        
        return $data;
    }
}
