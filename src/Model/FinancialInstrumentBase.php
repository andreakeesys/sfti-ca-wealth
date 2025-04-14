<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Base class for financial instruments
 */
abstract class FinancialInstrumentBase implements FinancialInstrument
{
    /**
     * @param string $type Type of the financial instrument
     * @param string $name Name of the financial instrument
     * @param array<FinancialInstrumentIdentification>|null $identificationList List of identification objects
     * @param string|null $cfiCode CFI code
     * @param string|null $currencyOfDenomination ISO 4217 currency code
     * @param bool|null $hasFactor Indicates if there is a factor present
     * @param float|null $factor Information regarding the factor
     * @param string|null $additionalDetails Additional information about the financial instrument
     */
    public function __construct(
        private readonly string $type,
        private readonly string $name,
        private readonly ?array $identificationList = null,
        private readonly ?string $cfiCode = null,
        private readonly ?string $currencyOfDenomination = null,
        private readonly ?bool $hasFactor = null,
        private readonly ?float $factor = null,
        private readonly ?string $additionalDetails = null
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentificationList(): ?array
    {
        return $this->identificationList;
    }

    /**
     * {@inheritdoc}
     */
    public function getCfiCode(): ?string
    {
        return $this->cfiCode;
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrencyOfDenomination(): ?string
    {
        return $this->currencyOfDenomination;
    }

    /**
     * {@inheritdoc}
     */
    public function getHasFactor(): ?bool
    {
        return $this->hasFactor;
    }

    /**
     * {@inheritdoc}
     */
    public function getFactor(): ?float
    {
        return $this->factor;
    }

    /**
     * {@inheritdoc}
     */
    public function getAdditionalDetails(): ?string
    {
        return $this->additionalDetails;
    }
    
    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        $data = [
            'type' => $this->type,
            'name' => $this->name,
        ];
        
        if ($this->identificationList !== null) {
            $data['identificationList'] = array_map(
                fn(FinancialInstrumentIdentification $identification) => $identification->toArray(),
                $this->identificationList
            );
        }
        
        if ($this->cfiCode !== null) {
            $data['cfiCode'] = $this->cfiCode;
        }
        
        if ($this->currencyOfDenomination !== null) {
            $data['currencyOfDenomination'] = $this->currencyOfDenomination;
        }
        
        if ($this->hasFactor !== null) {
            $data['hasFactor'] = $this->hasFactor;
        }
        
        if ($this->factor !== null) {
            $data['factor'] = $this->factor;
        }
        
        if ($this->additionalDetails !== null) {
            $data['additionalDetails'] = $this->additionalDetails;
        }
        
        return $data;
    }
    
    /**
     * Create identification list from array data
     *
     * @param array<array<string, mixed>> $identificationListData
     * @return array<FinancialInstrumentIdentification>
     */
    protected static function createIdentificationList(array $identificationListData): array
    {
        $identificationList = [];
        foreach ($identificationListData as $identificationData) {
            $identificationList[] = FinancialInstrumentIdentification::fromArray($identificationData);
        }
        return $identificationList;
    }
}
