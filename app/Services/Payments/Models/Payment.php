<?php

namespace App\Services\Payments\Models;

use App\Services\Orders\Models\Order;
use App\Services\Payments\Enums\PaymentDriverEnum;
use App\Services\Payments\Enums\PaymentStatusEnum;
use App\Support\Values\AmountValue;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int $id
 * @property string $uuid
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property PaymentStatusEnum $status
 * @property AmountValue $amount
 * @property string $payable_type
 * @property int $payable_id
 * @property Order $payable
 * @property int $method_id
 * @property PaymentMethod $method
 * @property PaymentDriverEnum $driver
 */

class Payment extends Model
{
    protected $fillable = [
        'uuid',
        'status',
        'currency_id', 'amount',
        'payable_type', 'payable_id',
        'method_id',
        'driver',
    ];

    protected $casts = [
        'status' => PaymentStatusEnum::class,
        'amount' => AmountValue::class,
        'driver' => PaymentDriverEnum::class,
    ];

    public function payable(): MorphTo
    {
        return $this->morphTo();
    }

    public function method(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

}
