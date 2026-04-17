<?php

namespace App\Services\Payments\Enums;

use function Laravel\Prompts\select;

enum PaymentDriverEnum: string
{
    case test = 'test';
    case tinkoff = 'tinkoff';

    public function name(): string
    {
        return match ($this) {
            self::test => 'Тестовый провайдер',
            self::tinkoff => 'Tinkoff'
        };
    }

    public function isTest(): bool
    {
        return $this === self::test;
    }
}
