<?php

namespace App\Services\Payments\Actions;

use App\Services\Payments\Enums\PaymentStatusEnum;
use App\Services\Payments\Events\PaymentCancelledEvent;
use App\Services\Payments\Events\PaymentData;
use App\Services\Payments\Models\Payment;

class CancelPaymentActon
{
    public function run(Payment $payment): void
    {
        $payment->status = PaymentStatusEnum::cancelled;
        $payment->save();

        event(new PaymentCancelledEvent(
            PaymentData::fromPayment($payment),
        ));
    }
}
