<?php

namespace App\Services\Payments\Actions;

use App\Services\Payments\Models\Payment;
use App\Services\Payments\Models\PaymentMethod;

class UpdatePaymentAction
{
    private PaymentMethod|null $method;

    public function method(PaymentMethod $method): static
    {
        $this->method = $method;
        return $this;
    }

    public function run(Payment $payment): void
    {
        if (!is_null($this->method)) {
            $payment->update([
                'method_id' => $this->method->id,
                'driver' => $this->method->driver
            ]);
        }
    }


}
