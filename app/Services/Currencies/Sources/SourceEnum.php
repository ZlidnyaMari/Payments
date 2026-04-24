<?php

namespace App\Services\Currencies\Sources;

enum SourceEnum: string
{
    case manual = 'manual';
    case cbrf = 'cbrf';
}
