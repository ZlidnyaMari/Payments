<?php

namespace App\Services\Orders\Actions;

use App\Services\Orders\Enum\OrdersStatusEnum;
use App\Services\Orders\Models\Order;

class CancelOrderAction
{
    public function run(Order $order): bool
    {
        $order->status = OrdersStatusEnum::cancelled;

        return $order->save();
    }
}
