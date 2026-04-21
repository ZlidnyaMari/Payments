<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\TinkoffServiceProvider::class,
    App\Services\Currencies\CurrencyServiceProvider::class,
    App\Services\Orders\OrderServiceProvider::class,
    App\Services\Payments\PaymentServiceProvider::class,
    App\Services\Subscriptions\SubscriptionServiceProvider::class,
];
