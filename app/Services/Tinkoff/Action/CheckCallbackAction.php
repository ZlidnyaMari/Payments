<?php

namespace App\Services\Tinkoff\Action;

use App\Services\Tinkoff\Dto\PaymentEntityData;
use App\Services\Tinkoff\Enums\PaymentStatusEnum;
use App\Services\Tinkoff\Exceptions\InvalidTokenException;
use App\Services\Tinkoff\TinkoffClient;
use App\Services\Tinkoff\TinkoffService;

class CheckCallbackAction
{
    public function __construct(
        private TinkoffService $tinkoff,
    ) {}

    public static function make(TinkoffService $tinkoff): static
    {
        return new static($tinkoff);
    }

    public function run(array $data): PaymentEntityData
    {
        $token = TinkoffClient::make($this->tinkoff)
            ->createToken($data);

        if ($data['Token'] !== $token) {
            throw new InvalidTokenException('Токен не верный');
        }

        return new PaymentEntityData(
            id: $data['PaymentId'],
            status: PaymentStatusEnum::from($data['Status']),
            order: $data['OrderId'],
            amount: $data['NewAmount'],
        );


    }
}
