<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/orders')->name('home');

Route::get('orders', [OrderController::class, 'index'])->name('orders');
Route::get('orders/{order:uuid}', [OrderController::class, 'show'])->name('orders.show');
Route::post('orders_payment/{order:uuid}', [OrderController::class, 'payment'])->name('orders.payment');

Route::get('payments/{payment:uuid}/checkout', [PaymentController::class, 'checkout'])->name('payments.checkout');
Route::post('payments/{payment:uuid}/method', [PaymentController::class, 'method'])->name('payments.method');
Route::get('payments/{payment:uuid}/process', [PaymentController::class, 'process'])->name('payments.process');
Route::post('payments/{payment:uuid}/complete', [PaymentController::class, 'complete'])->name('payments.complete');
Route::post('payments/{payment:uuid}/cancel', [PaymentController::class, 'cancel'])->name('payments.cancel');
Route::get('payments/success', [PaymentController::class, 'success'])->name('payments.success');
Route::get('payments/failure', [PaymentController::class, 'failure'])->name('payments.failure');
