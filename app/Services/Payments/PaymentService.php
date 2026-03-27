<?php

namespace App\Services\Payments;

use App\Services\Payments\Actions\CancelPaymentActon;
use App\Services\Payments\Actions\CompletePaymentActon;
use App\Services\Payments\Actions\CreatePaymentAction;
use App\Services\Payments\Actions\GetPaymentMethodAction;
use App\Services\Payments\Actions\GetPaymentsAction;
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

    public function getPayments(): GetPaymentsAction
    {
        return app(GetPaymentsAction::class);
    }

    public function updatePayment(): UpdatePaymentAction
    {
        return app(UpdatePaymentAction::class);
    }

    public function getPaymentMethods(): GetPaymentMethodAction
    {
        return app(GetPaymentMethodAction::class);
    }

    public function completePayment(): CompletePaymentActon
    {
        return app(CompletePaymentActon::class);
    }

    public function cancelPayment(): CancelPaymentActon
    {
        return app(CancelPaymentActon::class);
    }
}
