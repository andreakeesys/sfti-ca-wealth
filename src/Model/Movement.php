<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Movement model
 */
class Movement
{
    /**
     * @param string $type Type of movement
     * @param string $movementDate Date when the movement was confirmed
     * @param FinancialInstrument $financialInstrument Financial instrument
     * @param Account $account Account
     * @param Quantity $quantity Quantity
     * @param string $positionId Identification for the position given by the bank
     * @param string|null $positionCurrency ISO 4217 currency code
     * @param string|null $valueDate Date when calculating economic benefit for a cash amount
     * @param Price|null $price Price
     * @param ForeignExchangeRate|null $foreignExchangeRate Foreign exchange rate
     * @param string|null $movementTypeAdditionalInformation Additional information about the movement type
     */
    public function __construct(
        private readonly string $type,
        private readonly string $movementDate,
        private readonly FinancialInstrument $financialInstrument,
        private readonly Account $account,
        private readonly Quantity $quantity,
        private readonly string $positionId,
        private readonly ?string $positionCurrency = null,
        private readonly ?string $valueDate = null,
        private readonly ?Price $price = null,
        private readonly ?ForeignExchangeRate $foreignExchangeRate = null,
        private readonly ?string $movementTypeAdditionalInformation = null
    ) {
    }

    /**
     * Get the movement type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Get the movement date
     *
     * @return string
     */
    public function getMovementDate(): string
    {
        return $this->movementDate;
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
     * Get the quantity
     *
     * @return Quantity
     */
    public function getQuantity(): Quantity
    {
        return $this->quantity;
    }

    /**
     * Get the position ID
     *
     * @return string
     */
    public function getPositionId(): string
    {
        return $this->positionId;
    }

    /**
     * Get the position currency
     *
     * @return string|null
     */
    public function getPositionCurrency(): ?string
    {
        return $this->positionCurrency;
    }

    /**
     * Get the value date
     *
     * @return string|null
     */
    public function getValueDate(): ?string
    {
        return $this->valueDate;
    }

    /**
     * Get the price
     *
     * @return Price|null
     */
    public function getPrice(): ?Price
    {
        return $this->price;
    }

    /**
     * Get the foreign exchange rate
     *
     * @return ForeignExchangeRate|null
     */
    public function getForeignExchangeRate(): ?ForeignExchangeRate
    {
        return $this->foreignExchangeRate;
    }

    /**
     * Get the movement type additional information
     *
     * @return string|null
     */
    public function getMovementTypeAdditionalInformation(): ?string
    {
        return $this->movementTypeAdditionalInformation;
    }
    
    /**
     * Create a Movement from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        $financialInstrument = FinancialInstrumentFactory::createFromArray($data['financialInstrument']);
        $account = Account::fromArray($data['account']);
        $quantity = Quantity::fromArray($data['quantity']);
        
        $price = isset($data['price']) ? Price::fromArray($data['price']) : null;
        $foreignExchangeRate = isset($data['foreignExchangeRate']) 
            ? ForeignExchangeRate::fromArray($data['foreignExchangeRate']) 
            : null;
            
        return new self(
            $data['type'],
            $data['movementDate'],
            $financialInstrument,
            $account,
            $quantity,
            $data['positionId'],
            $data['positionCurrency'] ?? null,
            $data['valueDate'] ?? null,
            $price,
            $foreignExchangeRate,
            $data['movementTypeAdditionalInformation'] ?? null
        );
    }
    
    /**
     * Convert the Movement to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [
            'type' => $this->type,
            'movementDate' => $this->movementDate,
            'financialInstrument' => $this->financialInstrument->toArray(),
            'account' => $this->account->toArray(),
            'quantity' => $this->quantity->toArray(),
            'positionId' => $this->positionId,
        ];
        
        if ($this->positionCurrency !== null) {
            $data['positionCurrency'] = $this->positionCurrency;
        }
        
        if ($this->valueDate !== null) {
            $data['valueDate'] = $this->valueDate;
        }
        
        if ($this->price !== null) {
            $data['price'] = $this->price->toArray();
        }
        
        if ($this->foreignExchangeRate !== null) {
            $data['foreignExchangeRate'] = $this->foreignExchangeRate->toArray();
        }
        
        if ($this->movementTypeAdditionalInformation !== null) {
            $data['movementTypeAdditionalInformation'] = $this->movementTypeAdditionalInformation;
        }
        
        return $data;
    }
}
