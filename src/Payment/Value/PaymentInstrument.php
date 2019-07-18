<?php

namespace App\Payment\Value;

use Assert\Assert;

final class PaymentInstrument
{
    /** @var string */
    private $token;

    private function __construct(string $token)
    {
        Assert::that($token)
            ->length(32);

        $this->token = $token;
    }

    public static function fromToken(string $token) : self
    {
        return new self($token);
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
