<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Account Type enum
 * 
 * Represents the possible types of accounts in the Custody Services API
 */
enum AccountType: string
{
    case CASH_ACCOUNT = 'cashAccount';
    case SAFEKEEPING_ACCOUNT = 'safekeepingAccount';
    case OTHER = 'other';
}
