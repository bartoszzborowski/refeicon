<?php

namespace App\Console\Commands;

use App\Library\Dictionaries\CurrencyCode;
use App\Library\Services\Exchange\NBPExchangeService;
use App\Models\ExchangeRate;
use Illuminate\Console\Command;

class FetchExchangeRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:exchange_rates';

    private NBPExchangeService $exchangeService;


    /**
     * FetchExchangeRate constructor.
     * @param NBPExchangeService $exchangeService
     */
    public function __construct(NBPExchangeService $exchangeService)
    {
        parent::__construct();
        $this->exchangeService = $exchangeService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \App\Library\Exceptions\ExchangeFetchException
     * @throws \App\Library\Exceptions\InvalidCurrencyCodeException
     */
    public function handle()
    {
        collect([CurrencyCode::EUR_CODE, CurrencyCode::CHF_CODE, CurrencyCode::USD_CODE])->each(function (string $currency) {
            $result = $this->exchangeService->fetchExchangeRates(new CurrencyCode($currency));
            ExchangeRate::updateOrCreate(
                [ExchangeRate::FIELD_BASE_CURRENCY => CurrencyCode::PL_CODE, ExchangeRate::FIELD_CURRENCY => $currency],
                $result->toArray()
            );
            $this->info(sprintf('Update or create exchange for currency: %s', $currency));
        });
    }
}
