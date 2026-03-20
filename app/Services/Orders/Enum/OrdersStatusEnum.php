<?php

namespace App\Services\Orders\Enum;

enum OrdersStatusEnum: string
{
    case pending = 'pending';
    case completed = 'completed';
    case cancelled = 'cancelled';

    public function name(): string
    {
        return match ($this) {
            self::pending => 'Ожидает',
            self::completed => 'Завершено',
            self::cancelled => 'Отменено',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::pending => 'warning',
            self::completed => 'success',
            self::cancelled => 'danger',
        };
    }
}
