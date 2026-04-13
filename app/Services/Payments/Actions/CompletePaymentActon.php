<?php

namespace App\Services\Payments\Actions;

use App\Services\Payments\Enums\PaymentStatusEnum;
use App\Services\Payments\Events\PaymentData;
use App\Services\Payments\Events\PaymentCompletedEvent;
use App\Services\Payments\Models\Payment;

class CompletePaymentActon
{
    public function run(Payment $payment): void
    {
        $payment->status = PaymentStatusEnum::completed;
        $payment->save();

        //$payment->payable->onPaymentComplete(); // вот так в лоб обновлять статус у платежа плохо. как бы по хорошему
                                                  // action должен содержать одно действие, и если еще нужно что-нибудь будет сделать после
                                                    // обновления статуса, то action разрастется и будет не хорошо. лучше использовать или очереди или события
        event(new PaymentCompletedEvent(
            PaymentData::fromPayment($payment),
        ));
    }
}
