<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Transaction model
 */
class Transaction
{
    /**
     * @param string $id Transaction ID given by the bank
     * @param TransactionType $type Type of the transaction
     * @param string $transactionDate Date when the transaction entity is exposed in the API
     * @param string $customerId Unique and unambiguous identification used by the bank for the customer
     * @param bool $reversalIndicator Indicates whether it is the reversal of a previously reported movement
     * @param bool $endOfDayIndicator Indicates if the transaction has been confirmed by the end-of-day processing
     * @param string|null $reference Transaction reference as used in the transaction statement
     * @param string|null $description Human readable description of the transaction
     * @param PlaceOfTrade|null $placeOfTrade Market in which a trade transaction is to be or has been executed
     * @param string|null $reversedTransactionId Identification of the transaction that was reversed
     * @param string|null $tradeDate Date on which the trade was executed
     * @param string|null $settlementDate Date at which the securities are to be delivered or received
     * @param FinancialInstrument|null $triggeringFinancialInstrument Triggering financial instrument
     * @param Quantity|null $triggeringQuantity Triggering quantity
     * @param Price|null $triggeringPrice Triggering price
     * @param array<Movement>|null $movementList List of movements belonging to a transaction
     * @param array<PostingAmount>|null $postingAmountList List of total amounts of money
     * @param string|null $settlementCurrency Settlement currency
     * @param string|null $additionalDetails Additional details on the transaction
     */
    public function __construct(
        private readonly string $id,
        private readonly TransactionType $type,
        private readonly string $transactionDate,
        private readonly string $customerId,
        private readonly bool $reversalIndicator,
        private readonly bool $endOfDayIndicator,
        private readonly ?string $reference = null,
        private readonly ?string $description = null,
        private readonly ?PlaceOfTrade $placeOfTrade = null,
        private readonly ?string $reversedTransactionId = null,
        private readonly ?string $tradeDate = null,
        private readonly ?string $settlementDate = null,
        private readonly ?FinancialInstrument $triggeringFinancialInstrument = null,
        private readonly ?Quantity $triggeringQuantity = null,
        private readonly ?Price $triggeringPrice = null,
        private readonly ?array $movementList = null,
        private readonly ?array $postingAmountList = null,
        private readonly ?string $settlementCurrency = null,
        private readonly ?string $additionalDetails = null
    ) {
    }

    /**
     * Get the transaction ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get the transaction type
     *
     * @return TransactionType
     */
    public function getType(): TransactionType
    {
        return $this->type;
    }

    /**
     * Get the transaction date
     *
     * @return string
     */
    public function getTransactionDate(): string
    {
        return $this->transactionDate;
    }

    /**
     * Get the customer ID
     *
     * @return string
     */
    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    /**
     * Get the reversal indicator
     *
     * @return bool
     */
    public function getReversalIndicator(): bool
    {
        return $this->reversalIndicator;
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
     * Get the reference
     *
     * @return string|null
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * Get the description
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Get the place of trade
     *
     * @return PlaceOfTrade|null
     */
    public function getPlaceOfTrade(): ?PlaceOfTrade
    {
        return $this->placeOfTrade;
    }

    /**
     * Get the reversed transaction ID
     *
     * @return string|null
     */
    public function getReversedTransactionId(): ?string
    {
        return $this->reversedTransactionId;
    }

    /**
     * Get the trade date
     *
     * @return string|null
     */
    public function getTradeDate(): ?string
    {
        return $this->tradeDate;
    }

    /**
     * Get the settlement date
     *
     * @return string|null
     */
    public function getSettlementDate(): ?string
    {
        return $this->settlementDate;
    }

    /**
     * Get the triggering financial instrument
     *
     * @return FinancialInstrument|null
     */
    public function getTriggeringFinancialInstrument(): ?FinancialInstrument
    {
        return $this->triggeringFinancialInstrument;
    }

    /**
     * Get the triggering quantity
     *
     * @return Quantity|null
     */
    public function getTriggeringQuantity(): ?Quantity
    {
        return $this->triggeringQuantity;
    }

    /**
     * Get the triggering price
     *
     * @return Price|null
     */
    public function getTriggeringPrice(): ?Price
    {
        return $this->triggeringPrice;
    }

    /**
     * Get the movement list
     *
     * @return array<Movement>|null
     */
    public function getMovementList(): ?array
    {
        return $this->movementList;
    }

    /**
     * Get the posting amount list
     *
     * @return array<PostingAmount>|null
     */
    public function getPostingAmountList(): ?array
    {
        return $this->postingAmountList;
    }

    /**
     * Get the settlement currency
     *
     * @return string|null
     */
    public function getSettlementCurrency(): ?string
    {
        return $this->settlementCurrency;
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
     * Create a Transaction from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        // Create optional complex objects
        $placeOfTrade = isset($data['placeOfTrade']) ? PlaceOfTrade::fromArray($data['placeOfTrade']) : null;
        
        $triggeringFinancialInstrument = isset($data['triggeringFinancialInstrument']) 
            ? FinancialInstrumentFactory::createFromArray($data['triggeringFinancialInstrument']) 
            : null;
            
        $triggeringQuantity = isset($data['triggeringQuantity']) 
            ? Quantity::fromArray($data['triggeringQuantity']) 
            : null;
            
        $triggeringPrice = isset($data['triggeringPrice']) 
            ? Price::fromArray($data['triggeringPrice']) 
            : null;
            
        // Create movement list if present
        $movementList = null;
        if (isset($data['movementList']) && is_array($data['movementList'])) {
            $movementList = [];
            foreach ($data['movementList'] as $movementData) {
                $movementList[] = Movement::fromArray($movementData);
            }
        }
        
        // Create posting amount list if present
        $postingAmountList = null;
        if (isset($data['postingAmountList']) && is_array($data['postingAmountList'])) {
            $postingAmountList = [];
            foreach ($data['postingAmountList'] as $postingAmountData) {
                $postingAmountList[] = PostingAmount::fromArray($postingAmountData);
            }
        }
        
        return new self(
            $data['id'],
            TransactionType::from($data['type']),
            $data['transactionDate'],
            $data['customerId'],
            $data['reversalIndicator'],
            $data['endOfDayIndicator'],
            $data['reference'] ?? null,
            $data['description'] ?? null,
            $placeOfTrade,
            $data['reversedTransactionId'] ?? null,
            $data['tradeDate'] ?? null,
            $data['settlementDate'] ?? null,
            $triggeringFinancialInstrument,
            $triggeringQuantity,
            $triggeringPrice,
            $movementList,
            $postingAmountList,
            $data['settlementCurrency'] ?? null,
            $data['additionalDetails'] ?? null
        );
    }
    
    /**
     * Convert the Transaction to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [
            'id' => $this->id,
            'type' => $this->type->value,
            'transactionDate' => $this->transactionDate,
            'customerId' => $this->customerId,
            'reversalIndicator' => $this->reversalIndicator,
            'endOfDayIndicator' => $this->endOfDayIndicator,
        ];
        
        if ($this->reference !== null) {
            $data['reference'] = $this->reference;
        }
        
        if ($this->description !== null) {
            $data['description'] = $this->description;
        }
        
        if ($this->placeOfTrade !== null) {
            $data['placeOfTrade'] = $this->placeOfTrade->toArray();
        }
        
        if ($this->reversedTransactionId !== null) {
            $data['reversedTransactionId'] = $this->reversedTransactionId;
        }
        
        if ($this->tradeDate !== null) {
            $data['tradeDate'] = $this->tradeDate;
        }
        
        if ($this->settlementDate !== null) {
            $data['settlementDate'] = $this->settlementDate;
        }
        
        if ($this->triggeringFinancialInstrument !== null) {
            $data['triggeringFinancialInstrument'] = $this->triggeringFinancialInstrument->toArray();
        }
        
        if ($this->triggeringQuantity !== null) {
            $data['triggeringQuantity'] = $this->triggeringQuantity->toArray();
        }
        
        if ($this->triggeringPrice !== null) {
            $data['triggeringPrice'] = $this->triggeringPrice->toArray();
        }
        
        if ($this->movementList !== null) {
            $data['movementList'] = array_map(
                fn(Movement $movement) => $movement->toArray(),
                $this->movementList
            );
        }
        
        if ($this->postingAmountList !== null) {
            $data['postingAmountList'] = array_map(
                fn(PostingAmount $postingAmount) => $postingAmount->toArray(),
                $this->postingAmountList
            );
        }
        
        if ($this->settlementCurrency !== null) {
            $data['settlementCurrency'] = $this->settlementCurrency;
        }
        
        if ($this->additionalDetails !== null) {
            $data['additionalDetails'] = $this->additionalDetails;
        }
        
        return $data;
    }
}
