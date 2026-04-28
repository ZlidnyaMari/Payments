<?php

namespace App\Services\Currencies\Models;

use App\Services\Currencies\Sources\SourceEnum;
use App\Support\Values\AmountValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property string $id
 * @property string $name
 * @property AmountValue $price
 * @property SourceEnum $source
 */

class Currency extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    public const MAIN = 'RUB';
    public const RUB = 'RUB';
    public const USD = 'USD';
    public const EUR = 'EUR';

    protected $fillable = [
        'id', 'name',
        'price', 'source'
    ];

    protected $casts = [
        'price' => AmountValue::class,
        'source' => SourceEnum::class
    ];

    public function isMain(): bool
    {
       return $this->id === self::MAIN;
    }

    public function isNotMain(): bool
    {
        return !$this->isMain();
    }

    public static function getCached(): Collection // если используем пакет Laravel Octane то валюты закешируются навсегда, нужно будет ее сбрасывать.
    {
        static $cached;

        if ($cached) {
            return $cached;
        }

       return $cached = static::all();
    }
}
