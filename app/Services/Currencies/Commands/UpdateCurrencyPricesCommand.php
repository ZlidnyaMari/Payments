<?php

namespace App\Services\Currencies\Commands;

use App\Services\Currencies\CurrencyService;
use App\Services\Currencies\Sources\SourceEnum;
use Illuminate\Console\Command;

class UpdateCurrencyPricesCommand extends Command
{

    protected $signature = 'currencies:prices {source}';
    protected $description = 'обновление цен валют';

    public function handle(CurrencyService $service)
    {
        $this->warn("Обновление курсов валют");

        $this->updatePrices($service);

        $this->info("Курсы валют обновленны");
    }

    protected function updatePrices(CurrencyService $service)
    {
        $source = $service->getSource(
            SourceEnum::from($this->argument('source')));

        $service->updatePrices()->run($source);




    }
}
