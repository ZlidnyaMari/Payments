<?php

namespace App\Services\Currencies\Sources;

use Illuminate\Support\Collection;

class ManualSource extends Source
{
    public function getPrices(): Collection
    {
        return new Collection([]);
    }

    public function enum(): SourceEnum
    {
        return SourceEnum::manual;
    }
}
