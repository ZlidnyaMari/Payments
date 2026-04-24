<?php

namespace App\Services\Cbrf;

use Illuminate\Support\Facades\Http;

class ApiCbrfService
{
    public static function getCbrfDaily()
    {
        return Http::get('https://www.cbr-xml-daily.ru/daily_json.js')
            ->json();
    }
}
