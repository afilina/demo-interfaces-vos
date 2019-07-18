<?php

namespace App\Payment;

use App\Payment\Value\AmountWithCurrency;
use App\Payment\Value\PaymentInstrument;
use App\Payment\Value\TransactionId;

interface PaymentProvider
{
    public function purchase(PaymentInstrument $paymentInstrument, AmountWithCurrency $amountWithCurrency) : TransactionId;
}
