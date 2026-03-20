<?php

namespace App\Services\Currencies;

use App\Services\Currencies\Commands\InstallCurrenciesCommand;
use Illuminate\Support\ServiceProvider;

class CurrencyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/Migrations');
            $this->commands([
                InstallCurrenciesCommand::class
            ]);
        }
    }
}
