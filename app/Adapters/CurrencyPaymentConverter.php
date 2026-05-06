<?php

namespace App\Adapters;

use App\Services\Currencies\CurrencyService;
use App\Services\Payments\Contracts\PaymentConverter;
use App\Support\Values\AmountValue;

class CurrencyPaymentConverter implements PaymentConverter
{
    public function __construct(
        private CurrencyService $currencies
    )
    {}

    public function convert(AmountValue $amount, string $from, string $to): AmountValue
    {
        return $this->currencies
            ->convert()
            ->from($from)
            ->to($to)
            ->run($amount);
    }
}
