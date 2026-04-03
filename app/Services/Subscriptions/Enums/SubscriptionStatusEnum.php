<?php

namespace App\Services\Subscriptions\Enums;

enum SubscriptionStatusEnum: string
{
    case pending = 'pending';
    case active = 'active';
    case cancelled = 'cancelled';

    public function name(): string
    {
        return match ($this) {
            self::pending => 'Ожидает',
            self::active => 'Активная',
            self::cancelled => 'Отменено',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::pending => 'warning',
            self::active => 'success',
            self::cancelled => 'danger',
        };
    }

    public function is(SubscriptionStatusEnum $status): bool
    {
        return $this === $status;
    }

    public function isActive(): bool
    {
        return $this->is(self::active);
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
