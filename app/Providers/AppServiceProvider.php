<?php

namespace App\Providers;

use App\Adapters\CurrencyPaymentConverter;
use App\Services\Payments\Contracts\PaymentConverter;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PaymentConverter::class, CurrencyPaymentConverter::class);
    }

    public function boot(): void
    {
        bcscale(2);

        /*DB::listen(function (QueryExecuted $query) {
            info($query->sql);
        });*/
    }
}
