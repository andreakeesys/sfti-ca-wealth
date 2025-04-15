<?php

declare(strict_types=1);

namespace OpenWealth\CustodyServices\Model;

/**
 * Transaction Type enum
 * 
 * Represents the possible types of transactions in the Custody Services API
 */
enum TransactionType: string
{
    case ACCUMULATION = 'accumulation';
    case ADDITIONAL_PAYMENT = 'additionalPayment';
    case ADJUST_NOTIONAL = 'adjustNotional';
    case AMORTIZATION_AND_INTEREST_PAYMENT = 'amortizationAndInterestPayment';
    case ASSIGNMENT = 'assignment';
    case ASSIMILATION = 'assimilation';
    case BONUS = 'bonus';
    case BUY = 'buy';
    case BUY_TO_CLOSE = 'buyToClose';
    case CAPITAL_INCREASE = 'capitalIncrease';
    case CLOSE_CONTRACT = 'closeContract';
    case CONVERSION_BOND_SHARE = 'conversionBondShare';
    case COUPON = 'coupon';
    case CREDIT_EVENT = 'creditEvent';
    case DECREASE_PRINCIPAL = 'decreasePrincipal';
    case DELIVERY_FREE_OF_PAYMENT = 'deliveryFreeOfPayment';
    case DELIVERY_VS_PAYMENT = 'deliveryVsPayment';
    case DIVIDEND_CASH = 'dividendCash';
    case DIVIDEND_CHOICE = 'dividendChoice';
    case DIVIDEND_REINVESTMENT = 'dividendReinvestment';
    case DIVIDEND_STOCK = 'dividendStock';
    case EXERCISE = 'exercise';
    case EXPIRATION = 'expiration';
    case FEES = 'fees';
    case FINAL_LIQUIDATION_PAYMENT = 'finalLiquidationPayment';
    case FX_SPOT = 'fxSpot';
    case INCREASE_PRINCIPAL = 'increasePrincipal';
    case INFLOW_CASH = 'inflowCash';
    case INSTRUMENT_EXCHANGE = 'instrumentExchange';
    case INTEREST_PAYMENT = 'interestPayment';
    case INTERNAL_TRANSFER = 'internalTransfer';
    case LIQUIDATION_PAYMENT = 'liquidationPayment';
    case MERGER = 'merger';
    case OPEN_CONTRACT = 'openContract';
    case OTHER = 'other';
    case OUTFLOW_CASH = 'outflowCash';
    case PREMIUM = 'premium';
    case PREPAYMENT_SUBSTITUTION = 'prepaymentSubstitution';
    case RECEIVE_FREE_OF_PAYMENT = 'receiveFreeOfPayment';
    case RECEIVE_VS_PAYMENT = 'receiveVsPayment';
    case REDEMPTION = 'redemption';
    case REDEMPTION_PARTIAL = 'redemptionPartial';
    case REDEMPTION_PRIOR = 'redemptionPrior';
    case REDUCTION_OF_NOMINAL = 'reductionOfNominal';
    case RESET_PAYMENT = 'resetPayment';
    case RIGHT_DISTRIBUTION = 'rightDistribution';
    case SELL = 'sell';
    case SELL_TO_OPEN = 'sellToOpen';
    case SPIN_OFF = 'spinOff';
    case STOCK_SPLIT = 'stockSplit';
    case SUBSCRIPTION = 'subscription';
    case TAX_CORRECTIONS = 'taxCorrections';
    case TAXES = 'taxes';
    case TRANSFER_METAL_PHYSICAL = 'transferMetalPhysical';
    case UNWIND = 'unwind';
    case VARIATION_MARGIN = 'variationMargin';
}
