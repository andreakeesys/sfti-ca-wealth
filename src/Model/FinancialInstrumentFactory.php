<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

use InvalidArgumentException;

/**
 * Factory for creating financial instruments
 */
class FinancialInstrumentFactory
{
    /**
     * Create a financial instrument from an array of data
     *
     * @param array<string, mixed> $data
     * @return FinancialInstrument
     * @throws InvalidArgumentException If the instrument type is not supported
     */
    public static function createFromArray(array $data): FinancialInstrument
    {
        return match ($data['type']) {
            'cash' => Cash::fromArray($data),
            'bond' => Bond::fromArray($data),
            'equity' => Equity::fromArray($data),
            'fund' => Fund::fromArray($data),
            'index' => Index::fromArray($data),
            'commodity' => Commodity::fromArray($data),
            'option' => Option::fromArray($data),
            'future' => Future::fromArray($data),
            'fxForward' => FxForward::fromArray($data),
            'fxSwap' => FxSwap::fromArray($data),
            'fxOption' => FxOption::fromArray($data),
            'mortgage' => Mortgage::fromArray($data),
            'credit' => Credit::fromArray($data),
            'fixedLoan', 'fixedDeposit', 'callableLoan', 'callableDeposit' => MoneyMarket::fromArray($data),
            'interestRateSwap' => InterestRateSwap::fromArray($data),
            'totalReturnSwap' => TotalReturnSwap::fromArray($data),
            'creditDefaultSwap' => CreditDefaultSwap::fromArray($data),
            'cryptoAsset' => CryptoAsset::fromArray($data),
            'other' => OtherFinancialInstrument::fromArray($data),
            default => throw new InvalidArgumentException("Unsupported financial instrument type: {$data['type']}"),
        };
    }
}
