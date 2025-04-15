<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Account model
 */
class Account
{
    /**
     * @param string $id Unique and unambiguous identification for the account
     * @param AccountType $type Type of the account (cashAccount, safekeepingAccount, other)
     * @param string $referenceCurrency ISO 4217 currency code
     * @param string|null $name Name of the account
     * @param string|null $iban International Banking Account Number
     * @param string|null $number Proprietary account number
     * @param string|null $designation Supplementary information on the account
     * @param PortfolioInformation|null $portfolioInformation Information about the portfolio
     */
    public function __construct(
        private readonly string $id,
        private readonly AccountType $type,
        private readonly string $referenceCurrency,
        private readonly ?string $name = null,
        private readonly ?string $iban = null,
        private readonly ?string $number = null,
        private readonly ?string $designation = null,
        private readonly ?PortfolioInformation $portfolioInformation = null
    ) {
    }

    /**
     * Get the account ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get the account type
     *
     * @return AccountType
     */
    public function getType(): AccountType
    {
        return $this->type;
    }

    /**
     * Get the reference currency
     *
     * @return string
     */
    public function getReferenceCurrency(): string
    {
        return $this->referenceCurrency;
    }

    /**
     * Get the account name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Get the IBAN
     *
     * @return string|null
     */
    public function getIban(): ?string
    {
        return $this->iban;
    }

    /**
     * Get the account number
     *
     * @return string|null
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * Get the designation
     *
     * @return string|null
     */
    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    /**
     * Get the portfolio information
     *
     * @return PortfolioInformation|null
     */
    public function getPortfolioInformation(): ?PortfolioInformation
    {
        return $this->portfolioInformation;
    }
    
    /**
     * Create an Account from an array of data
     *
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        $portfolioInformation = isset($data['portfolioInformation']) 
            ? PortfolioInformation::fromArray($data['portfolioInformation']) 
            : null;
            
        return new self(
            $data['id'],
            AccountType::from($data['type']),
            $data['referenceCurrency'],
            $data['name'] ?? null,
            $data['iban'] ?? null,
            $data['number'] ?? null,
            $data['designation'] ?? null,
            $portfolioInformation
        );
    }
    
    /**
     * Convert the Account to an array
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [
            'id' => $this->id,
            'type' => $this->type->value,
            'referenceCurrency' => $this->referenceCurrency,
        ];
        
        if ($this->name !== null) {
            $data['name'] = $this->name;
        }
        
        if ($this->iban !== null) {
            $data['iban'] = $this->iban;
        }
        
        if ($this->number !== null) {
            $data['number'] = $this->number;
        }
        
        if ($this->designation !== null) {
            $data['designation'] = $this->designation;
        }
        
        if ($this->portfolioInformation !== null) {
            $data['portfolioInformation'] = $this->portfolioInformation->toArray();
        }
        
        return $data;
    }
}
