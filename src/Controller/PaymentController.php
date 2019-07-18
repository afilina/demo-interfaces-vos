<?php

namespace App\Controller;

use App\Payment\PaymentProvider;
use App\Payment\Value\AmountWithCurrency;
use App\Payment\Value\Currency;
use App\Payment\Value\PaymentInstrument;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentController
{
    /** @var PaymentProvider */
    private $paymentProvider;

    public function __construct(PaymentProvider $paymentProvider)
    {
        $this->paymentProvider = $paymentProvider;
    }

    public function purchase(Request $request) : Response
    {
        $transactionId = $this->paymentProvider->purchase(
            PaymentInstrument::fromToken($request->get('token')),
            AmountWithCurrency::fromCentsAndCurrency(
                250,
                Currency::fromCode('USD')
            )
        );

        return new Response(json_encode([
            'transactionId' => (string) $transactionId,
        ]), 200);
    }
}
