<?php

namespace App\Services\Tinkoff\Action;

use App\Services\Tinkoff\Enums\PaymentStatusEnum;
use App\Services\Tinkoff\Dto\CreatePaymentData;
use App\Services\Tinkoff\Dto\PaymentEntityData;
use App\Services\Tinkoff\Exceptions\TinkoffExeption;
use App\Services\Tinkoff\TinkoffClient;
use App\Services\Tinkoff\TinkoffService;
use Illuminate\Support\Facades\Http;

class CancelPaymentAction
{
    public function __construct(
        private TinkoffService $tinkoff,
    ) {}

    public static function make(TinkoffService $tinkoff): static
    {
        return new static($tinkoff);
    }

    public function run(string $id): PaymentEntityData
    {
        $response = TinkoffClient::make($this->tinkoff)
            ->post('/v2/Cancel', [
                'TerminalKey' => $this->tinkoff->config->terminal,
                'PaymentId' => $id,
            ]);

        return new PaymentEntityData(
            id: $response['PaymentId'],
            status: PaymentStatusEnum::from($response['Status']),
            order: $response['OrderId'],
            amount: $response['NewAmount'],
        );
    }
}
