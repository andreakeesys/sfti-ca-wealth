<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Commodity financial instrument
 */
class Commodity extends FinancialInstrumentBase
{
    /**
     * Type identifier for Commodity instruments
     */
    public const TYPE = 'commodity';
    
    /**
     * Create a Commodity from an array of data
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
