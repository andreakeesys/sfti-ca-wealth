<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Interest Rate Type enum
 * 
 * Represents the possible types of interest rates in the Custody Services API
 */
enum InterestRateType: string
{
    case FIXED = 'fixed';
    case VARIABLE = 'variable';
    case STAGGERED = 'staggered';
}
