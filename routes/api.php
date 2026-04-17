<?php

use App\Http\Controllers\Api\Payments\Callbacks\TinkoffController;
use Illuminate\Support\Facades\Route;

Route::post('payments/callbacks/tinkoff', [TinkoffController::class])->name('payments.callbacks.tinkoff');
