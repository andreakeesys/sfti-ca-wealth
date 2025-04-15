<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Option Style enum
 * 
 * Represents the possible styles of options in the Custody Services API
 */
enum OptionStyle: string
{
    case AMERICAN = 'american';
    case EUROPEAN = 'european';
    case BERMUDAN = 'bermudan';
    case ASIAN = 'asian';
}
