<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePaymentRequest;
use App\Services\Payments\Models\Payment;
use App\Services\Payments\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
            //->currency($payment->currency_id)
            ->active(true)
            ->get();

        return view('payments.checkout', compact('payment', 'methods'));
    }

    public function method(Payment $payment, UpdatePaymentRequest $request): RedirectResponse
    {
        abort_unless($payment->status->isPending(), 404);
        $validate = $request->validated();

        $method = $this->paymentService
            ->getPaymentMethods()
           // ->currency($payment->currency_id)
            ->id($validate['method_id'])
            ->active(true)
            ->first();

        abort_unless($method, 404);
       // abort_unless($payment->currency_id === $method->driver_currency_id, 404);

        $this->paymentService
            ->updatePayment()
            ->method($method)
            ->run($payment);

       return redirect()->route('payments.process', $payment->uuid);
    }

    public function process(Payment $payment): View
    {
        abort_unless($payment->status->isPending(), 404);
        abort_unless($payment->method_id, 404);

        $driver = $this->paymentService->getDriver($payment->driver);

        return $driver->view($payment);
        //return \view("payments::{$payment->driver->value}", compact('payment'));

    }
    //только тестовый способ оплаты
    public function complete(Payment $payment): RedirectResponse
    {
        abort_unless($payment->status->isPending(), 404);
        abort_unless($payment->driver->isTest(), 404);
        abort_if(app()->isProduction(), 404);

        $this->paymentService->completePayment()->run($payment);

        return redirect()->route('payments.success', [
            'uuid' => $payment->uuid
        ]);
    }

    public function cancel(Payment $payment): RedirectResponse
    {
        abort_unless($payment->status->isPending(), 404);
        abort_unless($payment->driver->isTest(), 404);
        abort_if(app()->isProduction(), 404);

        $this->paymentService->cancelPayment()->run($payment);

        return redirect()->route('payments.failure', [
            'uuid' => $payment->uuid
        ]);
    }

    public function success(Request $request): View
    {
        $uuid = $request->input('uuid');

        abort_unless(Str::isUuid($uuid), 404);

        $payment = $this->paymentService->getPayments()->uuid($uuid)->first();

        return \view('payments.success', compact('payment'));
    }

    public function failure(Request $request): string
    {
        $uuid = $request->input('uuid');

        abort_unless(Str::isUuid($uuid), 404);

        $payment = $this->paymentService->getPayments()->uuid($uuid)->first();

        return \view('payments.failure', compact('payment'));
    }
}
