<?php

namespace App\Services\Payments;

use App\Services\Payments\Actions\CreatePaymentAction;
use App\Services\Payments\Actions\FindPaymentMethodAction;
use App\Services\Payments\Actions\GetPaymentMethodAction;
use App\Services\Payments\Actions\UpdatePaymentAction;
use App\Services\Payments\Drivers\PaymentDriver;
use App\Services\Payments\Drivers\PaymentDriverFactory;
use App\Services\Payments\Enums\PaymentDriverEnum;

class PaymentService
{
    public function getDriver(PaymentDriverEnum $driver): PaymentDriver
    {
        return ( new PaymentDriverFactory )->make($driver);
    }

    public function createPayment(): CreatePaymentAction
    {
        return app(CreatePaymentAction::class);
    }

    public function findPaymentMethod(): FindPaymentMethodAction
    {
        return app(FindPaymentMethodAction::class);
    }

    public function updatePayment(): UpdatePaymentAction
    {
        return app(UpdatePaymentAction::class);
    }

    public function getPaymentMethods(): GetPaymentMethodAction
    {
        return app(GetPaymentMethodAction::class);
    }
}
