<?php

use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/orders')->name('home');
Route::post('currency/{currency}', CurrencyController::class)->name('currency');

Route::get('orders', [OrderController::class, 'index'])->name('orders');
Route::get('orders/{order:uuid}', [OrderController::class, 'show'])->name('orders.show')->whereUuid('order');
Route::post('orders_payment/{order:uuid}', [OrderController::class, 'payment'])->name('orders.payment')->whereUuid('order');

Route::get('payments/{payment:uuid}/checkout', [PaymentController::class, 'checkout'])->name('payments.checkout')->whereUuid('payment');
Route::post('payments/{payment:uuid}/method', [PaymentController::class, 'method'])->name('payments.method')->whereUuid('payment');
Route::get('payments/{payment:uuid}/process', [PaymentController::class, 'process'])->name('payments.process')->whereUuid('payment');
Route::post('payments/{payment:uuid}/complete', [PaymentController::class, 'complete'])->name('payments.complete')->whereUuid('payment');
Route::post('payments/{payment:uuid}/cancel', [PaymentController::class, 'cancel'])->name('payments.cancel')->whereUuid('payment');
Route::get('payments/success', [PaymentController::class, 'success'])->name('payments.success');
Route::get('payments/failure', [PaymentController::class, 'failure'])->name('payments.failure');

Route::get('subscription', [SubscriptionController::class, 'index'])->name('subscription');
Route::get('subscription/create', [SubscriptionController::class, 'create'])->name('subscription.create');
Route::get('subscription/{subscription:uuid}', [SubscriptionController::class, 'show'])->name('subscription.show');
Route::post('subscription', [SubscriptionController::class, 'store'])->name('subscription.store');
Route::post('subscription_payment/{subscription:uuid}', [SubscriptionController::class, 'payment'])->name('subscription.payment');
