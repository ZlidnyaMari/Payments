<?php

namespace App\Http\Controllers;

use App\Services\Orders\Models\Order;
use App\Services\Payments\PaymentService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::query()->get();
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order, Request $request): View
    {
        /*$user = $request->user();
        abort_unless($user->own($order), 404);*/   // проверка что заказ принадлежит пользователю не помешает в реальных проектах

        return view('orders.show', compact('order'));
    }

    public function payment(Order $order, PaymentService $paymentService): RedirectResponse
    {
        $payment = $paymentService
            ->createPayment()
            ->payable($order)
            ->run();

        return to_route('payments.checkout', $payment->uuid);
    }
}
