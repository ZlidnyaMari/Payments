<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePaymentRequest;
use App\Services\Payments\Models\Payment;
use App\Services\Payments\PaymentService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{
    public function __construct(
        protected PaymentService $paymentService,
    )
    {}

    public function checkout(Payment $payment): View
    {
        $methods = $this->paymentService
            ->getPaymentMethods()
            ->active(true)
            ->run();

        return view('payments.checkout', compact('payment', 'methods'));
    }

    public function method(Payment $payment, UpdatePaymentRequest $request): RedirectResponse
    {
        abort_unless($payment->status->isPending(), 404);
        $validate = $request->validated();

        $method = $this->paymentService
            ->findPaymentMethod()
            ->id($validate['method_id'])
            ->active(true)
            ->run();

        $this->paymentService
            ->updatePayment()
            ->method($method)
            ->run($payment);

       return redirect()->route('payments.process', $payment->uuid);
    }

    public function process(Payment $payment): string
    {
        abort_unless($payment->status->isPending(), 404);
        return 'Оплата выбранныым способом: ' . $payment->method->name;
    }
}
