<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Equity financial instrument
 */
class Equity extends FinancialInstrumentBase
{
    /**
     * Type identifier for Equity instruments
     */
    public const TYPE = 'equity';
    
    /**
     * Create an Equity from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        $identificationList = isset($data['identificationList']) 
            ? self::createIdentificationList($data['identificationList']) 
            : null;
            
        return new self(
            $data['type'],
            $data['name'],
            $identificationList,
            $data['cfiCode'] ?? null,
            $data['currencyOfDenomination'] ?? null,
            $data['hasFactor'] ?? null,
            isset($data['factor']) ? (float)$data['factor'] : null,
            $data['additionalDetails'] ?? null
        );
    }
}
