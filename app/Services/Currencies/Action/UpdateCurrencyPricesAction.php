<?php

namespace App\Services\Currencies\Action;

use App\Services\Currencies\Models\Currency;
use App\Services\Currencies\Sources\Source;
use App\Services\Currencies\Sources\SourceException;
use Illuminate\Support\Collection;

class UpdateCurrencyPricesAction
{
    public function run(Source $source): Collection
    {
        $currencies = Currency::query()
            ->where('source', $source->enum())
            ->get();

        if ($currencies->isEmpty()) {
            return $currencies;
        }

        $prices = $source->getPrices();

        if ($prices->isEmpty()) {
            return $currencies;
        }

        foreach ($currencies as $currency) {
            $price = $prices->firstWhere('currency', $currency->id);

            if ($price) {
                $currency->update([
                    'price' => $price->value,
                ]);
            } else {
                throw new SourceException("Не удалось получить цену валюты {$currency->id}");
        }}

        $currency->update(['price' => $price->value]);

        return $currencies;
    }
}
