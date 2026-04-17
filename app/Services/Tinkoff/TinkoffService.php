<?php

namespace App\Services\Tinkoff;

use App\Services\Tinkoff\Action\CancelPaymentAction;
use App\Services\Tinkoff\Action\CheckCallbackAction;
use App\Services\Tinkoff\Action\CreatePaymentAction;
use App\Services\Tinkoff\Action\FindPaymentAction;
use App\Services\Tinkoff\Dto\CreatePaymentData;
use App\Services\Tinkoff\Dto\PaymentEntityData;
use App\Services\Tinkoff\Exceptions\InvalidTokenException;
use App\Services\Tinkoff\Exceptions\TinkoffExeption;

class TinkoffService
{
    public function __construct(
       public TinkoffConfig $config
    ) {}

    public function createPayment(CreatePaymentData $data): PaymentEntityData
    {
        return CreatePaymentAction::make($this)->run($data);
    }

    /**
     * @throws TinkoffExeption
     */
    public function findPayment(string $id): PaymentEntityData
    {
        return FindPaymentAction::make($this)->run($id);
    }

    public function cancelPayment(string $id): PaymentEntityData
    {
        return CancelPaymentAction::make($this)->run($id);
    }

    /**
     * @throws InvalidTokenException
     */
    public function checkCallback(array $data): PaymentEntityData
    {
        return CheckCallbackAction::make($this)->run($data);
    }
}
