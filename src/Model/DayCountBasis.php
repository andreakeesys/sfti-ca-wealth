<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Day Count Basis enum
 * 
 * Represents the possible day count basis methods in the Custody Services API
 */
enum DayCountBasis: string
{
    case ACT_360 = 'act_360';
    case ACT_365 = 'act_365';
    case ACT_ACT_ICMA = 'act_actIcma';
    case ACT_ACT_ISDA = 'act_actIsda';
    case ACT_ACT_AFB = 'act_actAfb';
    case ACT_365L = 'act_365L';
    case BUS_252 = 'bus_252';
    case U30_360 = 'u30_360';
    case U30E_360_ICMA = 'u30E_360Icma';
    case U30E_360_ISDA = 'u30E_360Isda';
    case U30E_360 = 'u30E_360';
    case U30U_360 = 'u30U_360';
}
