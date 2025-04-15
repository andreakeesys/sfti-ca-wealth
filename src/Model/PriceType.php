<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Price Type enum
 * 
 * Represents the possible types of prices in the Custody Services API
 */
enum PriceType: string
{
    case ACTUAL = 'actual';
    case PERCENTAGE = 'percentage';
}
