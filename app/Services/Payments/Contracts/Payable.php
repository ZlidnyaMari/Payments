<?php

namespace App\Services\Payments\Contracts;

use App\Support\Values\AmountValue;

interface Payable
{
    public function getPayableName(): string;
    public function getPayableCurrencyId(): string;
    public function getPayableAmount():AmountValue;
    public function getPayableType(): string;
    public function getPayableId(): int;
    public function getPayableUrl(): string;
}
