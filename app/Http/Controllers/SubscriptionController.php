<?php

namespace App\Http\Controllers;

use App\Services\Payments\PaymentService;
use App\Services\Subscriptions\Enums\SubscriptionStatusEnum;
use App\Services\Subscriptions\Models\Subscription;
use App\Support\Values\AmountValue;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SubscriptionController extends Controller
{
    public function __construct(
        protected PaymentService $paymentService,
    ){}

    public function index(): View
    {
        $subscriptions = Subscription::query()
            ->latest('id')
            ->get();

        return view('subscriptions.index', compact('subscriptions'));
    }

    public function create(): View
    {
        return view('subscriptions.create');
    }

    public function store()
    {
        $subscription = Subscription::query()->create([
            'uuid' => (string) Str::uuid(),
            'currency_id' => currency(),
            'price' => convert(new AmountValue(1000)),
            'status' => SubscriptionStatusEnum::pending,
        ]);

        $payment = $this->paymentService
            ->createPayment()
            ->payable($subscription)
            ->run();

        return to_route('payments.checkout', $payment->uuid);
    }

    public function show(Subscription $subscription): View
    {
        return view('subscriptions.show', compact('subscription'));
    }

    public function payment(Subscription $subscription)
    {
        abort_unless($subscription->status->isPending(), 404);

        $payment = $this->paymentService
            ->createPayment()
            ->payable($subscription)
            ->run();

        return to_route('payments.checkout', $payment->uuid);
    }
}
