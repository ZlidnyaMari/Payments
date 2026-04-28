<?php

namespace App\Services\Currencies\Commands;

use App\Services\Currencies\Models\Currency;
use App\Services\Currencies\Sources\SourceEnum;
use App\Support\Values\AmountValue;
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
                [
                    'name' => 'Рубль',
                    'price' => new AmountValue(1),
                    'source' => SourceEnum::manual,
                ]
            );

        Currency::query()
            ->firstOrCreate(
                ['id' => Currency::USD],
                [
                    'name' => 'Доллар',
                    'price' => new AmountValue(100),
                    'source' => SourceEnum::cbrf,
                ]
            );

        Currency::query()
            ->firstOrCreate(
                ['id' => Currency::EUR],
                [
                    'name' => 'Евро',
                    'price' => new AmountValue(110),
                    'source' => SourceEnum::cbrf,
                ]
            );


    }
}
