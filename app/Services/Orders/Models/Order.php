<?php

namespace App\Services\Orders\Models;

use App\Services\Orders\Enum\OrdersStatusEnum;
use App\Services\Payments\Contracts\Payable;
use App\Support\Values\AmountValue;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $uuid
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property AmountValue $amount
 * @property OrdersStatusEnum $status
 * @property string $currency_id
 */

class Order extends Model implements Payable
{
    protected $fillable = [
        'uuid',
        'status',
        'amount',
        'currency_id',
   ];

   protected $casts = [
       'status' => OrdersStatusEnum::class,
       'amount' => AmountValue::class,
   ];

    public function getPayableName(): string
    {
       return "Заказ {$this->uuid}";
    }

    public function getPayableCurrencyId(): string
    {
        return $this->currency_id;
    }
    public function getPayableAmount():AmountValue
    {
        return $this->amount;
    }
    public function getPayableType(): string
    {
        return $this->getMorphClass();
    }
    public function getPayableId(): int
    {
        return $this->id;
    }

    public function getPayableUrl(): string
    {
        return route('orders.show', $this->uuid);
    }

    public function onPaymentComplete(): void
    {
        info("Payment complete", ['id' => $this->uuid]);
    }
}
