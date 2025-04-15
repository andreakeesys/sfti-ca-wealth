<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * FX Forward financial instrument
 */
class FxForward extends FinancialInstrumentBase
{
    /**
     * Type identifier for FX Forward instruments
     */
    public const TYPE = 'fxForward';
    
    /**
     * @param CurrencyAmount $amountPaid Amount paid at maturity
     * @param CurrencyAmount $amountReceived Amount received at maturity
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
        private readonly CurrencyAmount $amountPaid,
        private readonly CurrencyAmount $amountReceived,
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
     * Get the amount paid
     *
     * @return CurrencyAmount
     */
    public function getAmountPaid(): CurrencyAmount
    {
        return $this->amountPaid;
    }

    /**
     * Get the amount received
     *
     * @return CurrencyAmount
     */
    public function getAmountReceived(): CurrencyAmount
    {
        return $this->amountReceived;
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
     * Create an FxForward from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        $identificationList = isset($data['identificationList']) 
            ? self::createIdentificationList($data['identificationList']) 
            : null;
            
        $amountPaid = CurrencyAmount::fromArray($data['amountPaid']);
        $amountReceived = CurrencyAmount::fromArray($data['amountReceived']);
            
        return new self(
            $data['type'],
            $data['name'],
            $identificationList,
            $data['cfiCode'] ?? null,
            $data['currencyOfDenomination'] ?? null,
            $data['hasFactor'] ?? null,
            isset($data['factor']) ? (float)$data['factor'] : null,
            $data['additionalDetails'] ?? null,
            $amountPaid,
            $amountReceived,
            $data['maturityDate']
        );
    }
    
    /**
     * Convert the FxForward to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = parent::toArray();
        
        $data['amountPaid'] = $this->amountPaid->toArray();
        $data['amountReceived'] = $this->amountReceived->toArray();
        $data['maturityDate'] = $this->maturityDate;
        
        return $data;
    }
}
