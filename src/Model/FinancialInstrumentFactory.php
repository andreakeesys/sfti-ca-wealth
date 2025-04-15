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
            Cash::TYPE => Cash::fromArray($data),
            Bond::TYPE => Bond::fromArray($data),
            Equity::TYPE => Equity::fromArray($data),
            Fund::TYPE => Fund::fromArray($data),
            Index::TYPE => Index::fromArray($data),
            Commodity::TYPE => Commodity::fromArray($data),
            Option::TYPE => Option::fromArray($data),
            Future::TYPE => Future::fromArray($data),
            FxForward::TYPE => FxForward::fromArray($data),
            FxSwap::TYPE => FxSwap::fromArray($data),
            FxOption::TYPE => FxOption::fromArray($data),
            Mortgage::TYPE => Mortgage::fromArray($data),
            Credit::TYPE => Credit::fromArray($data),
            MoneyMarket::TYPE_FIXED_LOAN, 
            MoneyMarket::TYPE_FIXED_DEPOSIT, 
            MoneyMarket::TYPE_CALLABLE_LOAN, 
            MoneyMarket::TYPE_CALLABLE_DEPOSIT => MoneyMarket::fromArray($data),
            InterestRateSwap::TYPE => InterestRateSwap::fromArray($data),
            TotalReturnSwap::TYPE => TotalReturnSwap::fromArray($data),
            CreditDefaultSwap::TYPE => CreditDefaultSwap::fromArray($data),
            CryptoAsset::TYPE => CryptoAsset::fromArray($data),
            OtherFinancialInstrument::TYPE => OtherFinancialInstrument::fromArray($data),
            default => throw new InvalidArgumentException("Unsupported financial instrument type: {$data['type']}"),
        };
    }
}
