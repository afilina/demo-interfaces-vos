<?php

namespace Tests\Unit\Payment\Value;

use App\Payment\Value\Currency;
use Assert\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/** @covers \App\Payment\Value\Currency */
final class CurrencyTest extends TestCase
{
    public function testCannotCreateWithInvalidCode() : void
    {
        $this->expectException(InvalidArgumentException::class);
        Currency::fromCode('INVALID');
    }

    public function testGetCurrencyCode() : void
    {
        self::assertEquals(
            'USD',
            Currency::fromCode('USD')->getCurrencyCode()
        );
    }
}
