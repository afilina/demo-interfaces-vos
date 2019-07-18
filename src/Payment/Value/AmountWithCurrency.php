<?php

namespace App\Payment\Value;

use Assert\Assert;

final class AmountWithCurrency
{
    /** @var int */
    private $amountInCents;
    /** @var Currency */
    private $currency;

    private function __construct(int $amountInCents, Currency $currency)
    {
        Assert::that($amountInCents)
            ->greaterOrEqualThan(0);

        $this->amountInCents = $amountInCents;
        $this->currency = $currency;
    }

    public static function fromCentsAndCurrency(int $amountInCents, Currency $currency) : self
    {
        return new self($amountInCents, $currency);
    }

    public static function fromDollarsFloatAndCurrency(float $amount, Currency $currency) : self
    {
        return new self($amount * 100, $currency);
    }

    public function getAmountInCents(): int
    {
        return $this->amountInCents;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }
}
