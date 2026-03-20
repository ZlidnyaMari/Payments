<?php

namespace App\Console\Commands;

use App\Services\Currencies\Commands\InstallCurrenciesCommand;
use App\Services\Payments\Commands\InstallPaymentsCommand;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'install';

    public function handle(): void
    {
        $this->warn('Установка приложения...');

        $this->call(InstallCurrenciesCommand::class);
        $this->call(InstallPaymentsCommand::class);

        $this->info('Приложение установлено...');
    }
}
