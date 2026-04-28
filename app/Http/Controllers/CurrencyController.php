<?php

namespace App\Http\Controllers;

use App\Services\Currencies\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function __invoke(Currency $currency)
    {
        session(['currency' => $currency->id]); // данные по выбору валюты на сайте или например языка можно хранить(зависит от задачи)
                                               // как в сессии(но это не долго) так и в куках(это лучше потому что можно хранить дольше).
        return back();
    }
}
