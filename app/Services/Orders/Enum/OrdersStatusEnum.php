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

    public function is(OrdersStatusEnum $status): bool
    {
        return $this === $status;
    }

    public function isCompleted(): bool
    {
        return $this->is(self::completed);
    }

    public function isPending(): bool
    {
        return $this->is(self::pending);
    }

    public function isCancelled(): bool
    {
        return $this->is(self::cancelled);
    }


}
