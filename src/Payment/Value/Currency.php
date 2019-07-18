<?php

namespace App\Payment\Value;

use Assert\Assert;

final class Currency
{
    /** @var string */
    private $currencyCode;

    private function __construct(string $currencyCode)
    {
        Assert::that($currencyCode)
            ->inArray(['USD', 'CAD', 'EUR', 'JPY']);

        $this->currencyCode = $currencyCode;
    }

    public static function fromCode(string $currencyCode) : self
    {
        return new self($currencyCode);
    }

    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }
}
