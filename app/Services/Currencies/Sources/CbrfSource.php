<?php

namespace App\Services\Currencies\Sources;

use App\Services\Cbrf\ApiCbrfService;
use Illuminate\Support\Collection;
use App\Support\Values\AmountValue;

class CbrfSource extends Source
{
    public function getPrices(): Collection
    {
        $prices = collect();
        $response = ApiCbrfService::getCbrfDaily();

        foreach ($response['Valute'] as $currency) {
            $prices->push(new SourcePriceDto(
                currency: $currency['CharCode'],
                value: new AmountValue($currency['Value'] / $currency['Nominal']),
            ));
        }

        return $prices;
    }

    public function enum(): SourceEnum
    {
        return SourceEnum::cbrf;
    }
}
