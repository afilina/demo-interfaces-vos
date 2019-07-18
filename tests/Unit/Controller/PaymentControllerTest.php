<?php
namespace Tests\Unit\Controller;


use App\Controller\PaymentController;
use App\Payment\PaymentProvider;
use App\Payment\Value\PaymentInstrument;
use App\Payment\Value\TransactionId;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/** @covers \App\Controller\PaymentController */
final class PaymentControllerTest extends TestCase
{
    private const TRANSACTION_ID = 'abc';
    const TOKEN = 'ab123456789012345678901234567890';

    /** @var PaymentProvider&MockObject */
    private $paymentProvider;

    /** @var PaymentController */
    private $controller;

    protected function setUp(): void
    {
        $this->paymentProvider = $this->createMock(PaymentProvider::class);

        $this->controller = new PaymentController(
            $this->paymentProvider
        );
    }

    public function testPurchase() : void
    {
        $this->paymentProvider
            ->expects($this->once())
            ->method('purchase')
            ->with(self::equalTo(
                PaymentInstrument::fromToken(self::TOKEN)
            ))
            ->willReturn(
                TransactionId::fromString(self::TRANSACTION_ID)
            );

        self::assertEquals(
            new Response(json_encode([
                'transactionId' => self::TRANSACTION_ID,
            ])),
            $this->controller->purchase(
                new Request([], ['token' => self::TOKEN])
            )
        );
    }
}
