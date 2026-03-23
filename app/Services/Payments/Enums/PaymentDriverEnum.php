<?php

namespace App\Services\Payments\Enums;

use function Laravel\Prompts\select;

enum PaymentDriverEnum: string
{
    case test = 'test';

    public function name(): string
    {
        return match ($this) {
            self::test => 'Тестовый провайдер',
        };
    }

    public function isTest(): bool
    {
        return $this === self::test;
    }
}
