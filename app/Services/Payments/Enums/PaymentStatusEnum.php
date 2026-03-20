<?php

namespace App\Services\Payments\Enums;

enum PaymentStatusEnum: string
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

    public function is(PaymentStatusEnum $status): bool
    {
        return $this === $status;
    }

    public function isPending(): bool
    {
        return $this->is(self::pending);
    }

    public function isCompleted(): bool
    {
        return $this->is(self::completed);
    }

    public function isCancelled(): bool
    {
        return  $this->is(self::cancelled);
    }
}
