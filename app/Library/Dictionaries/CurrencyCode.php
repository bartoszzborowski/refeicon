<?php


namespace App\Library\Dictionaries;


use App\Library\Exceptions\InvalidCurrencyCodeException;

class CurrencyCode
{
    public const USD_CODE = 'usd';
    public const CHF_CODE = 'chf';
    public const EUR_CODE = 'eur';
    public const PL_CODE = 'pl';

    private const CODE_LIST = [
      self::USD_CODE,
      self::CHF_CODE,
      self::EUR_CODE,
    ];

    private string $currencyCode;

    /**
     * CurrencyCode constructor.
     * @param string $code
     * @throws InvalidCurrencyCodeException
     */
    public function __construct(string $code)
    {
        $this->isValid($code);
        $this->currencyCode = $code;
    }

    /**
     * @return string
     */
    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }

    /**
     * @param string $code
     * @throws InvalidCurrencyCodeException
     */
    private function isValid(string $code): void
    {
        if(!in_array( $code,self::CODE_LIST, true)) {
            throw new InvalidCurrencyCodeException('Invalid currency code selected');
        }
    }
}
