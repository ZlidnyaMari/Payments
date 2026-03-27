<?php

namespace App\Services\Payments\Actions;

use App\Services\Payments\Enums\PaymentStatusEnum;
use App\Services\Payments\Models\Payment;

class CancelPaymentActon
{
    public function run(Payment $payment): bool
    {
        $payment->status = PaymentStatusEnum::cancelled;

        return $payment->save();
    }
}
