<?php

namespace App\Services\Currencies\Action;

use App\Services\Currencies\Models\Currency;
use App\Support\Values\AmountValue;

class ConvertCurrencyAction
{
    private string $from; //RUB
    private string $to; //USD

    public function from(string $from): static
    {
        $this->from = $from;
        return $this;
    }

    public function to(string $to): static
    {
        $this->to = $to;
        return $this;
    }

    public function run(AmountValue $amount): AmountValue
    {
        $currency = Currency::getCached();

        $from = $currency->firstWhere('id', $this->from);
        $to = $currency->firstWhere('id', $this->to);

        if ($from->isNotMain()) {
            $amount = $amount->mul($from->price, 8);
        }
        $result = $amount->div($to->price, 8);

        return new AmountValue($result);
    }
}
