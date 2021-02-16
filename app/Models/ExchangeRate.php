<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    public const FILED_ID = 'id';
    public const FIELD_BASE_CURRENCY = 'base_currency';
    public const FIELD_CURRENCY = 'currency';
    public const FIELD_AVG_VALUE = 'mid';
    public const FIELD_BOUGHT_PRICE = 'bid';
    public const FIELD_SELL_PRICE = 'ask';

    protected $fillable = [
        self::FIELD_BASE_CURRENCY,
        self::FIELD_CURRENCY,
        self::FIELD_AVG_VALUE,
        self::FIELD_BOUGHT_PRICE,
        self::FIELD_SELL_PRICE,
    ];
}
