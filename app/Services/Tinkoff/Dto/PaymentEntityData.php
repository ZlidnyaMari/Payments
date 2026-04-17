<?php

namespace App\Services\Tinkoff\Dto;

use App\Services\Tinkoff\Enums\PaymentStatusEnum;

class PaymentEntityData
{
    public function __construct(
        public string $id,
        public PaymentStatusEnum $status,
        public string $order,
        public int $amount,
        public ?string $url = null,
    ) {}
}
