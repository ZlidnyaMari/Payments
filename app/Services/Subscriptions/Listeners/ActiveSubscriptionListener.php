<?php

namespace App\Services\Subscriptions\Listeners;

use App\Services\Payments\Events\PaymentCompletedEvent;
use App\Services\Subscriptions\Enums\SubscriptionStatusEnum;
use App\Services\Subscriptions\Models\Subscription;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActiveSubscriptionListener implements ShouldQueue
{

    public function __construct()
    {
        //
    }

    public function handle(PaymentCompletedEvent $event): void
    {
        dd(123);
        $payableType = $event->data->payableType;
        $payableId = $event->data->payableId;

        if ($payableType !== (new Subscription)->getPayableType()) {
           return;
        };

        $subscription = Subscription::query()->find($payableId);

        if (is_null($subscription)) {
            return;
        }

        $subscription->update(['status' => SubscriptionStatusEnum::active]);
    }
}
