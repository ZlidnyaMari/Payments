<?php

namespace App\Services\Tinkoff\Enums;

enum PaymentStatusEnum: string
{
    case NEW = 'NEW';
    case CONFIRMED = 'CONFIRMED';
    case AUTHORIZED = 'AUTHORIZED';
    case REJECTED = 'REJECTED';
    case CANCELED = 'CANCELED';
    case REVERSED = 'REVERSED';
    case REFUNDED = 'REFUNDED';
 }
