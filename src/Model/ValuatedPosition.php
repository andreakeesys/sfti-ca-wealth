<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Valuated Position model
 */
class ValuatedPosition
{
    /**
     * @param string $id Identification for the position given by the bank
     * @param FinancialInstrument $financialInstrument Financial instrument
     * @param Account $account Account
     * @param bool $endOfDayIndicator Indicates if the position has been confirmed by the end-of-day processing
     * @param string $positionDate Date when the valuated position entity is exposed in the API
     * @param Quantity $quantity Quantity entity
     * @param Valuation $valuation Valuation entity
     * @param string|null $name Name of the position
     * @param string|null $currency ISO 4217 currency code
     * @param string|null $safekeepingPlace BIC of the place where the securities are safe-kept
     * @param string|null $additionalCustodianInformation Additional custodian information
     * @param string|null $additionalDetails Additional details about the position
     * @param ValuationPrice|null $price Price used for valuation
     * @param ValuationForeignExchangeRate|null $foreignExchangeRate Foreign exchange rate
     * @param Price|null $costPrice Cost price
     * @param ForeignExchangeRate|null $costForeignExchangeRate Cost foreign exchange rate
     * @param CurrencyAmount|null $accruedInterest Accrued interest
     * @param int|null $numberOfDaysAccrued Number of days used for calculating the accrued interest
     * @param Quantity|null $blockedQuantity Amount of the position which is blocked
     */
    public function __construct(
        private readonly string $id,
        private readonly FinancialInstrument $financialInstrument,
        private readonly Account $account,
        private readonly bool $endOfDayIndicator,
        private readonly string $positionDate,
        private readonly Quantity $quantity,
        private readonly Valuation $valuation,
        private readonly ?string $name = null,
        private readonly ?string $currency = null,
        private readonly ?string $safekeepingPlace = null,
        private readonly ?string $additionalCustodianInformation = null,
        private readonly ?string $additionalDetails = null,
        private readonly ?ValuationPrice $price = null,
        private readonly ?ValuationForeignExchangeRate $foreignExchangeRate = null,
        private readonly ?Price $costPrice = null,
        private readonly ?ForeignExchangeRate $costForeignExchangeRate = null,
        private readonly ?CurrencyAmount $accruedInterest = null,
        private readonly ?int $numberOfDaysAccrued = null,
        private readonly ?Quantity $blockedQuantity = null
    ) {
    }

    /**
     * Get the position ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get the financial instrument
     *
     * @return FinancialInstrument
     */
    public function getFinancialInstrument(): FinancialInstrument
    {
        return $this->financialInstrument;
    }

    /**
     * Get the account
     *
     * @return Account
     */
    public function getAccount(): Account
    {
        return $this->account;
    }

    /**
     * Get the end of day indicator
     *
     * @return bool
     */
    public function getEndOfDayIndicator(): bool
    {
        return $this->endOfDayIndicator;
    }

    /**
     * Get the position date
     *
     * @return string
     */
    public function getPositionDate(): string
    {
        return $this->positionDate;
    }

    /**
     * Get the quantity
     *
     * @return Quantity
     */
    public function getQuantity(): Quantity
    {
        return $this->quantity;
    }

    /**
     * Get the valuation
     *
     * @return Valuation
     */
    public function getValuation(): Valuation
    {
        return $this->valuation;
    }

    /**
     * Get the position name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Get the currency
     *
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * Get the safekeeping place
     *
     * @return string|null
     */
    public function getSafekeepingPlace(): ?string
    {
        return $this->safekeepingPlace;
    }

    /**
     * Get the additional custodian information
     *
     * @return string|null
     */
    public function getAdditionalCustodianInformation(): ?string
    {
        return $this->additionalCustodianInformation;
    }

    /**
     * Get the additional details
     *
     * @return string|null
     */
    public function getAdditionalDetails(): ?string
    {
        return $this->additionalDetails;
    }

    /**
     * Get the price
     *
     * @return ValuationPrice|null
     */
    public function getPrice(): ?ValuationPrice
    {
        return $this->price;
    }

    /**
     * Get the foreign exchange rate
     *
     * @return ValuationForeignExchangeRate|null
     */
    public function getForeignExchangeRate(): ?ValuationForeignExchangeRate
    {
        return $this->foreignExchangeRate;
    }

    /**
     * Get the cost price
     *
     * @return Price|null
     */
    public function getCostPrice(): ?Price
    {
        return $this->costPrice;
    }

    /**
     * Get the cost foreign exchange rate
     *
     * @return ForeignExchangeRate|null
     */
    public function getCostForeignExchangeRate(): ?ForeignExchangeRate
    {
        return $this->costForeignExchangeRate;
    }

    /**
     * Get the accrued interest
     *
     * @return CurrencyAmount|null
     */
    public function getAccruedInterest(): ?CurrencyAmount
    {
        return $this->accruedInterest;
    }

    /**
     * Get the number of days accrued
     *
     * @return int|null
     */
    public function getNumberOfDaysAccrued(): ?int
    {
        return $this->numberOfDaysAccrued;
    }

    /**
     * Get the blocked quantity
     *
     * @return Quantity|null
     */
    public function getBlockedQuantity(): ?Quantity
    {
        return $this->blockedQuantity;
    }
    
    /**
     * Create a ValuatedPosition from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        // Create required complex objects
        $financialInstrument = FinancialInstrumentFactory::createFromArray($data['financialInstrument']);
        $account = Account::fromArray($data['account']);
        $quantity = Quantity::fromArray($data['quantity']);
        $valuation = Valuation::fromArray($data['valuation']);
        
        // Create optional complex objects
        $price = isset($data['price']) ? ValuationPrice::fromArray($data['price']) : null;
        $foreignExchangeRate = isset($data['foreignExchangeRate']) 
            ? ValuationForeignExchangeRate::fromArray($data['foreignExchangeRate']) 
            : null;
        $costPrice = isset($data['costPrice']) ? Price::fromArray($data['costPrice']) : null;
        $costForeignExchangeRate = isset($data['costForeignExchangeRate']) 
            ? ForeignExchangeRate::fromArray($data['costForeignExchangeRate']) 
            : null;
        $accruedInterest = isset($data['accruedInterest']) 
            ? CurrencyAmount::fromArray($data['accruedInterest']) 
            : null;
        $blockedQuantity = isset($data['blockedQuantity']) 
            ? Quantity::fromArray($data['blockedQuantity']) 
            : null;
            
        return new self(
            $data['id'],
            $financialInstrument,
            $account,
            $data['endOfDayIndicator'],
            $data['positionDate'],
            $quantity,
            $valuation,
            $data['name'] ?? null,
            $data['currency'] ?? null,
            $data['safekeepingPlace'] ?? null,
            $data['additionalCustodianInformation'] ?? null,
            $data['additionalDetails'] ?? null,
            $price,
            $foreignExchangeRate,
            $costPrice,
            $costForeignExchangeRate,
            $accruedInterest,
            $data['numberOfDaysAccrued'] ?? null,
            $blockedQuantity
        );
    }
    
    /**
     * Convert the ValuatedPosition to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [
            'id' => $this->id,
            'financialInstrument' => $this->financialInstrument->toArray(),
            'account' => $this->account->toArray(),
            'endOfDayIndicator' => $this->endOfDayIndicator,
            'positionDate' => $this->positionDate,
            'quantity' => $this->quantity->toArray(),
            'valuation' => $this->valuation->toArray(),
        ];
        
        if ($this->name !== null) {
            $data['name'] = $this->name;
        }
        
        if ($this->currency !== null) {
            $data['currency'] = $this->currency;
        }
        
        if ($this->safekeepingPlace !== null) {
            $data['safekeepingPlace'] = $this->safekeepingPlace;
        }
        
        if ($this->additionalCustodianInformation !== null) {
            $data['additionalCustodianInformation'] = $this->additionalCustodianInformation;
        }
        
        if ($this->additionalDetails !== null) {
            $data['additionalDetails'] = $this->additionalDetails;
        }
        
        if ($this->price !== null) {
            $data['price'] = $this->price->toArray();
        }
        
        if ($this->foreignExchangeRate !== null) {
            $data['foreignExchangeRate'] = $this->foreignExchangeRate->toArray();
        }
        
        if ($this->costPrice !== null) {
            $data['costPrice'] = $this->costPrice->toArray();
        }
        
        if ($this->costForeignExchangeRate !== null) {
            $data['costForeignExchangeRate'] = $this->costForeignExchangeRate->toArray();
        }
        
        if ($this->accruedInterest !== null) {
            $data['accruedInterest'] = $this->accruedInterest->toArray();
        }
        
        if ($this->numberOfDaysAccrued !== null) {
            $data['numberOfDaysAccrued'] = $this->numberOfDaysAccrued;
        }
        
        if ($this->blockedQuantity !== null) {
            $data['blockedQuantity'] = $this->blockedQuantity->toArray();
        }
        
        return $data;
    }
}
