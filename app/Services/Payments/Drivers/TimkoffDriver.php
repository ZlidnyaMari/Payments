<?php

namespace App\Services\Payments\Drivers;

use App\Services\Payments\Models\Payment;
use App\Services\Tinkoff\Dto\CreatePaymentData;
use App\Services\Tinkoff\TinkoffService;
use Illuminate\View\View;

class TimkoffDriver extends PaymentDriver
{
    public function __construct(
        private TinkoffService $tinkoffService
    ) {}
    public function view(Payment $payment): View
    {
       $entity = $this->tinkoffService->createPayment(
            new CreatePaymentData(
                amount: $payment->amount->value() * 100, // тинькоф работает с суммами в копейках, можно метод преобразования написать в сам Enum
                order: $payment->uuid, // важно что бы он не повторялся и платежи не путались, по этому используем uuid
                successUrl: route('payments.success', ['uuid' => $payment->uuid]),
                failureUrl: route('payments.failure', ['uuid' => $payment->uuid]),
                callbackUrl: '', // можно использовать сайт webhook.site для того что бы тестить ответы или ngrok или другие
            )
        );

       $payment->update(['driver_payment_id' => $entity->id]);

        return view('payments::tinkoff', compact('payment', 'entity'));
    }
}
