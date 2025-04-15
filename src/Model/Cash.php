<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Cash financial instrument
 */
class Cash extends FinancialInstrumentBase
{
    /**
     * Type identifier for Cash instruments
     */
    public const TYPE = 'cash';
    
    /**
     * Create a Cash from an array of data
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
