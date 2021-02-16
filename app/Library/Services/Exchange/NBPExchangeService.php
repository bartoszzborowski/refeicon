<?php


namespace App\Library\Services\Exchange;


use App\Library\Dictionaries\CurrencyCode;
use App\Library\Exceptions\ExchangeFetchException;
use App\Library\Model\ExchangeResultModel;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class NBPExchangeService implements ExchangeServiceInterface
{
    private const TABLE_TYPE_A = 'a';
    private const TABLE_TYPE_B = 'b';
    private const TABLE_TYPE_C = 'c';

    private const TABLE_TYPES = [
        self::TABLE_TYPE_A,
        self::TABLE_TYPE_B,
        self::TABLE_TYPE_C
    ];

    private string $baseUrl;

    public function __construct(string $url)
    {
        $this->baseUrl = str_ends_with($url, '/') ? $url : sprintf('%s/', $url);
    }

    /**
     * @param CurrencyCode $currencyCode
     * @return ExchangeResultModel
     * @throws ExchangeFetchException
     */
    public function fetchExchangeRates(CurrencyCode $currencyCode): ExchangeResultModel
    {
        $fetchUrlTableC = $this->buildUrl(sprintf('rates/%s/%s/today', self::TABLE_TYPE_C, $currencyCode->getCurrencyCode()));
        $fetchUrlTableA = $this->buildUrl(sprintf('rates/%s/%s/today', self::TABLE_TYPE_A, $currencyCode->getCurrencyCode()));
        $responseTableA = Http::get($fetchUrlTableA);
        $responseTableC = Http::get($fetchUrlTableC);

        if($responseTableA->failed() || $responseTableC->failed()) {
            throw new ExchangeFetchException();
        }

        return new ExchangeResultModel(
            $currencyCode->getCurrencyCode(),
            $this->getResult($responseTableA)['rates'][0]['mid'],
            $this->getResult($responseTableC)['rates'][0]['bid'],
            $this->getResult($responseTableC)['rates'][0]['ask']
        );
    }

    /**
     * @param Response $response
     * @return array
     */
    private function getResult(Response $response): array
    {
        return json_decode($response->body(), true);
    }

    /**
     * @param string $url
     * @param bool $returnJson
     * @return string
     */
    private function buildUrl(string $url, bool $returnJson = true): string
    {
        return sprintf('%s%s%s', $this->baseUrl, $url, $returnJson ? '/?format=json' : '');
    }
}
