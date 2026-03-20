<?php

namespace App\Services\Currencies\Commands;

use App\Services\Currencies\Models\Currency;
use Illuminate\Console\Command;

class InstallCurrenciesCommand extends Command
{
    protected $signature = 'currencies:install';

    public function handle(): void
    {
        $this->warn('Установка валют');

        $this->installCurrencies();

        $this->info('Установка валют завершена');
    }

    private function installCurrencies(): void
    {
        Currency::query()
            ->firstOrCreate(
                ['id' => Currency::RUB],
                ['name' => 'Рубль']
            );
    }
}
