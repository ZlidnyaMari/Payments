<?php

namespace App\Http\Controllers\Api\Payments\Callbacks;

use App\Http\Controllers\Controller;
use App\Services\Payments\PaymentService;
use App\Services\Tinkoff\Enums\PaymentStatusEnum;
use App\Services\Tinkoff\Exceptions\InvalidTokenException;
use App\Services\Tinkoff\TinkoffConfig;
use App\Services\Tinkoff\TinkoffService;
use Illuminate\Http\Request;

class TinkoffController extends Controller
{
    public function __invoke(Request $request, PaymentService $paymentService)
    {
        $config = config('services.tinkoff');

        $tinkoffService = new TinkoffService(
            new TinkoffConfig(
                terminal: $config['terminal'],
                password: $config['password']
            ),
        );

        try {
            $entity = $tinkoffService->checkCallback($request->all());
            $payment = $paymentService->getPayments()->uuid($entity->order)->first(); // не лишним будет проверить наличие платежа.

            match ($entity->status) {
                PaymentStatusEnum::CONFIRMED => $paymentService->completePayment()->run($payment),
                PaymentStatusEnum::REJECTED,
                PaymentStatusEnum:: REVERSED,
                PaymentStatusEnum::CANCELED,
                PaymentStatusEnum:: REFUNDED =>  $paymentService->cancelPayment()->run($payment),
                default => null
            };

        } catch (InvalidTokenException $e) {
            report($e); // если злоумышленик пытается подделать токен, и отправить запрос, если отлавливаем исключение у нас падает ошибка 500
                        // это не есть хорошо, лучше если у нас исключение все таки отловится сохранить его в лог и всегда отдавать какой-либо ответ.
                        //  в доке тинькова это 200
        }

        return response('OK', 200);
    }
}
