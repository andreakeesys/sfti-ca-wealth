<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Interest Rate Swap financial instrument
 */
class InterestRateSwap extends FinancialInstrumentBase
{
    /**
     * Type identifier for Interest Rate Swap instruments
     */
    public const TYPE = 'interestRateSwap';
    
    /**
     * @param CurrencyAmount $notionalAmount Notional amount
     * @param InterestRate $interestRatePaid Interest rate paid
     * @param InterestRate $interestRateReceived Interest rate received
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
        private readonly InterestRate $interestRatePaid,
        private readonly InterestRate $interestRateReceived,
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
     * Get the interest rate paid
     *
     * @return InterestRate
     */
    public function getInterestRatePaid(): InterestRate
    {
        return $this->interestRatePaid;
    }

    /**
     * Get the interest rate received
     *
     * @return InterestRate
     */
    public function getInterestRateReceived(): InterestRate
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
     * Create an InterestRateSwap from an array of data
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
        $interestRatePaid = InterestRate::fromArray($data['interestRatePaid']);
        $interestRateReceived = InterestRate::fromArray($data['interestRateReceived']);
            
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
            $interestRatePaid,
            $interestRateReceived,
            $data['maturityDate'] ?? null
        );
    }
    
    /**
     * Convert the InterestRateSwap to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = parent::toArray();
        
        $data['notionalAmount'] = $this->notionalAmount->toArray();
        $data['interestRatePaid'] = $this->interestRatePaid->toArray();
        $data['interestRateReceived'] = $this->interestRateReceived->toArray();
        
        if ($this->maturityDate !== null) {
            $data['maturityDate'] = $this->maturityDate;
        }
        
        return $data;
    }
}
