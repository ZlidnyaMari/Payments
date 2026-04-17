<?php

namespace App\Services\Tinkoff\Action;

use App\Services\Tinkoff\Enums\PaymentStatusEnum;
use App\Services\Tinkoff\Dto\CreatePaymentData;
use App\Services\Tinkoff\Dto\PaymentEntityData;
use App\Services\Tinkoff\TinkoffClient;
use App\Services\Tinkoff\TinkoffService;

class CreatePaymentAction
{
    public function __construct(
        private TinkoffService $tinkoff,
    ) {}

    public static function make(TinkoffService $tinkoff): static
    {
        return new static($tinkoff);
    }

    public function run(CreatePaymentData $data): PaymentEntityData
    {
        $response = TinkoffClient::make($this->tinkoff)
            ->post('/v2/Init', [
                'TerminalKey' => $this->tinkoff->config->terminal,
                'Amount' => $data->amount,
                'OrderId' => $data->order,
                'SuccessURL' => $data->successUrl,
                'FailURL' => $data->failureUrl,
                'NotificationURL' => $data->callbackUrl,
            ]);

        return new PaymentEntityData(
          id: $response['PaymentId'],
          status: PaymentStatusEnum::from($response['Status']),
          order: $response['OrderId'],
          amount: $response['Amount'],
          url: $response['PaymentURL']
        );
    }
}
