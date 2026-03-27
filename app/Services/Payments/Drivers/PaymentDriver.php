<?php

namespace App\Services\Payments\Drivers;

use App\Services\Payments\Models\Payment;
use Illuminate\View\View;

abstract class PaymentDriver
{
    abstract public function view(Payment $payment): View;
}
