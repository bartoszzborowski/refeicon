<?php


namespace App\Http\Services;


use App\Library\Dictionaries\CurrencyCode;
use App\Models\ExchangeRate;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExchangeService
{
    /**
     * @param CurrencyCode $currency
     * @param float $value
     * @return array
     */
    public function calculateExchangeForCurrency(CurrencyCode $currency, float $value): array
    {
        /** @var Collection $exchange */
        $exchange = ExchangeRate::where(
            [ExchangeRate::FIELD_BASE_CURRENCY => CurrencyCode::PL_CODE, ExchangeRate::FIELD_CURRENCY => $currency->getCurrencyCode()]
        )->get();

        if($exchange->isEmpty()) {
            throw new NotFoundHttpException();
        }
        $exchange = $exchange->first();
        return [
            'mid' => number_format($exchange->{ExchangeRate::FIELD_AVG_VALUE} * $value),
            'bid' => number_format($exchange->{ExchangeRate::FIELD_BOUGHT_PRICE} * $value),
            'ask' => number_format($exchange->{ExchangeRate::FIELD_SELL_PRICE} * $value),
        ];
    }
}
