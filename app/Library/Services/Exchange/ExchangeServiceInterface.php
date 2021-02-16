<?php


namespace App\Library\Services\Exchange;


use App\Library\Dictionaries\CurrencyCode;
use App\Library\Model\ExchangeResultModel;

interface ExchangeServiceInterface
{
    public function fetchExchangeRates(CurrencyCode $currencyCode): ExchangeResultModel;
}
