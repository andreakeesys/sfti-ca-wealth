<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Interest Rate model
 */
class InterestRate
{
    /**
     * @param InterestRateType $type Type of interest (fixed, variable, staggered)
     * @param float|null $value Current rate as decimal
     * @param string|null $dayCountBasis Day count basis
     * @param string|null $paymentDate Date of the next interest payment
     * @param string|null $paymentFrequency Frequency of an interest payment
     * @param string|null $basis Benchmark by which floating rate will adjust
     * @param float|null $spread The floating rate will be equal to the base rate plus the spread
     */
    public function __construct(
        private readonly InterestRateType $type,
        private readonly ?float $value = null,
        private readonly ?string $dayCountBasis = null,
        private readonly ?string $paymentDate = null,
        private readonly ?string $paymentFrequency = null,
        private readonly ?string $basis = null,
        private readonly ?float $spread = null
    ) {
    }

    /**
     * Get the interest rate type
     *
     * @return InterestRateType
     */
    public function getType(): InterestRateType
    {
        return $this->type;
    }

    /**
     * Get the interest rate value
     *
     * @return float|null
     */
    public function getValue(): ?float
    {
        return $this->value;
    }

    /**
     * Get the day count basis
     *
     * @return string|null
     */
    public function getDayCountBasis(): ?string
    {
        return $this->dayCountBasis;
    }

    /**
     * Get the payment date
     *
     * @return string|null
     */
    public function getPaymentDate(): ?string
    {
        return $this->paymentDate;
    }

    /**
     * Get the payment frequency
     *
     * @return string|null
     */
    public function getPaymentFrequency(): ?string
    {
        return $this->paymentFrequency;
    }

    /**
     * Get the basis
     *
     * @return string|null
     */
    public function getBasis(): ?string
    {
        return $this->basis;
    }

    /**
     * Get the spread
     *
     * @return float|null
     */
    public function getSpread(): ?float
    {
        return $this->spread;
    }
    
    /**
     * Create an InterestRate from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self(
            InterestRateType::from($data['type']),
            isset($data['value']) ? (float)$data['value'] : null,
            $data['dayCountBasis'] ?? null,
            $data['paymentDate'] ?? null,
            $data['paymentFrequency'] ?? null,
            $data['basis'] ?? null,
            isset($data['spread']) ? (float)$data['spread'] : null
        );
    }
    
    /**
     * Convert the InterestRate to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [
            'type' => $this->type->value,
        ];
        
        if ($this->value !== null) {
            $data['value'] = $this->value;
        }
        
        if ($this->dayCountBasis !== null) {
            $data['dayCountBasis'] = $this->dayCountBasis;
        }
        
        if ($this->paymentDate !== null) {
            $data['paymentDate'] = $this->paymentDate;
        }
        
        if ($this->paymentFrequency !== null) {
            $data['paymentFrequency'] = $this->paymentFrequency;
        }
        
        if ($this->basis !== null) {
            $data['basis'] = $this->basis;
        }
        
        if ($this->spread !== null) {
            $data['spread'] = $this->spread;
        }
        
        return $data;
    }
}
