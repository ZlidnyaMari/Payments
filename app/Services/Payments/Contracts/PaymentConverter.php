<?php

namespace App\Services\Payments\Contracts;

use App\Support\Values\AmountValue;

interface PaymentConverter
{
    public function convert(AmountValue $amount, string $from, string $to): AmountValue;
}
