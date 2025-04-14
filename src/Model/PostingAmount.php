<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Posting Amount model
 */
class PostingAmount
{
    /**
     * @param float $amount Signed amount of the cash transaction
     * @param string $currency ISO 4217 currency code
     * @param Account $account Account
     */
    public function __construct(
        private readonly float $amount,
        private readonly string $currency,
        private readonly Account $account
    ) {
    }

    /**
     * Get the amount
     *
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Get the currency
     *
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
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
     * Create a PostingAmount from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        $account = Account::fromArray($data['account']);
        
        return new self(
            (float)$data['amount'],
            $data['currency'],
            $account
        );
    }
    
    /**
     * Convert the PostingAmount to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'amount' => $this->amount,
            'currency' => $this->currency,
            'account' => $this->account->toArray(),
        ];
    }
}
