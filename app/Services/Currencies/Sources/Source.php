<?php

namespace App\Services\Currencies\Sources;

use Illuminate\Support\Collection;

abstract class Source
{
    abstract public function getPrices(): Collection;
    abstract public function enum(): SourceEnum;
}
