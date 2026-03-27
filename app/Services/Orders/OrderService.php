<?php

namespace App\Services\Orders;

use App\Services\Orders\Actions\CompleteOrderAction;

class OrderService
{
    public function completeOrder(): CompleteOrderAction
    {
        return app(CompleteOrderAction::class);
    }
}
