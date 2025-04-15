<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Quantity Type enum
 * 
 * Represents the possible types of quantities in the Custody Services API
 */
enum QuantityType: string
{
    case UNIT = 'unit';
    case FACE_AMOUNT = 'faceAmount';
    case AMORTISED_VALUE = 'amortisedValue';
    case DIGITAL_TOKEN_UNIT = 'digitalTokenUnit';
}
