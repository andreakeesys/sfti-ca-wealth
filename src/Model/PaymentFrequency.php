<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Payment Frequency enum
 * 
 * Represents the possible payment frequencies in the Custody Services API
 */
enum PaymentFrequency: string
{
    case ANNUAL = 'annual';
    case MONTHLY = 'monthly';
    case QUARTERLY = 'quarterly';
    case SEMI_ANNUAL = 'semiAnnual';
    case WEEKLY = 'weekly';
    case AT_MATURITY = 'atMaturity';
    case OTHER = 'other';
}
