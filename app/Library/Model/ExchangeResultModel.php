<?php


namespace App\Library\Model;


class ExchangeResultModel
{
    private string $currency;
    private float $mid;
    private float $bid;
    private float $ask;

    public function __construct(string $currency, float $mid, float $bid, float $ask)
    {
        $this->currency= $currency;
        $this->mid = $mid;
        $this->bid = $bid;
        $this->ask = $ask;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return float
     */
    public function getMid(): float
    {
        return $this->mid;
    }

    /**
     * @return float
     */
    public function getBid(): float
    {
        return $this->bid;
    }

    /**
     * @return float
     */
    public function getAsk(): float
    {
        return $this->ask;
    }

    public function toArray()
    {
        return [
            'bid' => $this->getBid(),
            'ask' => $this->getAsk(),
            'mid' => $this->getAsk(),
            'currency' => $this->getCurrency()
        ];
    }
}
