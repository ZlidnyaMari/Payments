<?php

namespace App\Services\Currencies\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $name
 */

class Currency extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    public const RUB = 'RUB';

    protected $fillable = [
        'id', 'name',
    ];


}
