<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * FX Swap financial instrument
 */
class FxSwap extends FinancialInstrumentBase
{
    /**
     * Type identifier for FX Swap instruments
     */
    public const TYPE = 'fxSwap';
    
    /**
     * @param CurrencyAmount $nearAmountPaid Amount paid at the earlier part
     * @param CurrencyAmount $nearAmountReceived Amount received at the earlier part
     * @param CurrencyAmount $farAmountPaid Amount paid at maturity
     * @param CurrencyAmount $farAmountReceived Amount received at maturity
     * @param string $nearMaturityDate Date of the settlement of the near leg
     * @param string $maturityDate Maturity date
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
        private readonly CurrencyAmount $nearAmountPaid,
        private readonly CurrencyAmount $nearAmountReceived,
        private readonly CurrencyAmount $farAmountPaid,
        private readonly CurrencyAmount $farAmountReceived,
        private readonly string $nearMaturityDate,
        private readonly string $maturityDate
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
     * Get the near amount paid
     *
     * @return CurrencyAmount
     */
    public function getNearAmountPaid(): CurrencyAmount
    {
        return $this->nearAmountPaid;
    }

    /**
     * Get the near amount received
     *
     * @return CurrencyAmount
     */
    public function getNearAmountReceived(): CurrencyAmount
    {
        return $this->nearAmountReceived;
    }

    /**
     * Get the far amount paid
     *
     * @return CurrencyAmount
     */
    public function getFarAmountPaid(): CurrencyAmount
    {
        return $this->farAmountPaid;
    }

    /**
     * Get the far amount received
     *
     * @return CurrencyAmount
     */
    public function getFarAmountReceived(): CurrencyAmount
    {
        return $this->farAmountReceived;
    }

    /**
     * Get the near maturity date
     *
     * @return string
     */
    public function getNearMaturityDate(): string
    {
        return $this->nearMaturityDate;
    }

    /**
     * Get the maturity date
     *
     * @return string
     */
    public function getMaturityDate(): string
    {
        return $this->maturityDate;
    }

    /**
     * Create an FxSwap from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        $identificationList = isset($data['identificationList']) 
            ? self::createIdentificationList($data['identificationList']) 
            : null;
            
        $nearAmountPaid = CurrencyAmount::fromArray($data['nearAmountPaid']);
        $nearAmountReceived = CurrencyAmount::fromArray($data['nearAmountReceived']);
        $farAmountPaid = CurrencyAmount::fromArray($data['farAmountPaid']);
        $farAmountReceived = CurrencyAmount::fromArray($data['farAmountReceived']);
            
        return new self(
            $data['type'],
            $data['name'],
            $identificationList,
            $data['cfiCode'] ?? null,
            $data['currencyOfDenomination'] ?? null,
            $data['hasFactor'] ?? null,
            isset($data['factor']) ? (float)$data['factor'] : null,
            $data['additionalDetails'] ?? null,
            $nearAmountPaid,
            $nearAmountReceived,
            $farAmountPaid,
            $farAmountReceived,
            $data['nearMaturityDate'],
            $data['maturityDate']
        );
    }
    
    /**
     * Convert the FxSwap to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = parent::toArray();
        
        $data['nearAmountPaid'] = $this->nearAmountPaid->toArray();
        $data['nearAmountReceived'] = $this->nearAmountReceived->toArray();
        $data['farAmountPaid'] = $this->farAmountPaid->toArray();
        $data['farAmountReceived'] = $this->farAmountReceived->toArray();
        $data['nearMaturityDate'] = $this->nearMaturityDate;
        $data['maturityDate'] = $this->maturityDate;
        
        return $data;
    }
}
