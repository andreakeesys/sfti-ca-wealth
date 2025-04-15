<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Option Type enum
 * 
 * Represents the possible types of options in the Custody Services API
 */
enum OptionType: string
{
    case CALL = 'call';
    case PUT = 'put';
}
