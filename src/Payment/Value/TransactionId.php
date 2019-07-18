<?php

namespace App\Payment\Value;

use Assert\Assert;

class TransactionId
{
    /** @var string */
    private $transactionId;

    public function __construct(string $transactionId)
    {
        Assert::that($transactionId)
            ->notBlank();

        $this->transactionId = $transactionId;
    }

    public static function fromString(string $transactionId) : self
    {
        return new self($transactionId);
    }

    public function __toString(): string
    {
        return $this->transactionId;
    }
}
