<?php

namespace App\Services\Currencies\Sources;

use App\Support\Values\AmountValue;

class SourcePriceDto
{
    public function __construct(
        public string $currency,
        public AmountValue $value,
    ) {
    }
}
