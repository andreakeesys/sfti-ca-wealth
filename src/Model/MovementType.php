<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Movement Type enum
 * 
 * Represents the possible types of movements in the Custody Services API
 */
enum MovementType: string
{
    case ACCRUED_INTEREST = 'accruedInterest';
    case ADDITIONAL_WITHHOLDING_TAX = 'additionalWithholdingTax';
    case ASSET = 'asset';
    case BROKERAGE_FEE = 'brokerageFee';
    case CAPITAL_GAIN_TAX = 'capitalGainTax';
    case CASH = 'cash';
    case COMMISSION = 'commission';
    case CUSTODY_FEE = 'custodyFee';
    case EXCHANGE_FEE = 'exchangeFee';
    case FINANCIAL_TRANSACTION_TAX = 'financialTransactionTax';
    case INTEREST = 'interest';
    case MANAGEMENT_FEE = 'managementFee';
    case OTHER_FEE = 'otherFee';
    case OTHER = 'other';
    case OTHER_TAX = 'otherTax';
    case PREMIUM = 'premium';
    case RECLAIMABLE_TAX = 'reclaimableTax';
    case REINVESTMENT_AMOUNT = 'reinvestmentAmount';
    case STAMP_DUTY = 'stampDuty';
    case THIRD_PARTY_FEE = 'thirdPartyFee';
    case TRANSACTION_FEE = 'transactionFee';
    case VALUE_ADDED_TAX = 'valueAddedTax';
    case WITHHOLDING_TAX = 'withholdingTax';
}
