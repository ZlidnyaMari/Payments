<?php

namespace App\Services\Payments\Models;

use App\Services\Payments\Enums\PaymentDriverEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property boolean $active
 * @property PaymentDriverEnum $driver
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class PaymentMethod extends Model
{
    protected $fillable = [
        'name', 'active',
        'driver',
    ];

    protected $casts = [
        'active' => 'boolean',
        'driver' => PaymentDriverEnum::class,
    ];
}
