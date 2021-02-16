<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExchangeRate;
use App\Http\Services\ExchangeService;
use App\Library\Dictionaries\CurrencyCode;
use Illuminate\Http\Request;

class ExchangeApiController extends Controller
{
    /**
     * @var ExchangeService
     */
    private ExchangeService $exchangeService;

    public function __construct(ExchangeService $exchangeService)
    {
        $this->exchangeService = $exchangeService;
    }

    /**
     * @param string $currency
     * @param float $value
     * @return ExchangeRate
     * @throws \App\Library\Exceptions\InvalidCurrencyCodeException
     */
    public function exchangeFromCurrency(string $currency, float $value): ExchangeRate
    {
        $currency = new CurrencyCode($currency);

        return new ExchangeRate(
            $this->exchangeService->calculateExchangeForCurrency($currency, $value)
        );
    }
}
