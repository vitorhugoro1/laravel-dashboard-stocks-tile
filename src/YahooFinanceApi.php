<?php

namespace VitorHugoRo\StockTile;

use Scheb\YahooFinanceApi\ApiClient;
use Scheb\YahooFinanceApi\ApiClientFactory;

class YahooFinanceApi
{
    /** @var ApiClient */
    private $client;

    public function __construct()
    {
        $this->client = ApiClientFactory::createApiClient();
    }

    /**
     * @param string $stock
     *
     * @return array|null
     */
    public function getQuote(string $stock)
    {
        $quote = $this->client->getQuote($stock);

        if (!$quote) {
            return null;
        }

        return [
            'name' => $quote->getLongName(),
            'symbol' => $quote->getSymbol(),
            'isMarketOpen' => $quote->getMarketState(),
            'now' => $quote->getRegularMarketPrice(),
            'dayLow' => $quote->getRegularMarketDayLow(),
            'dayHigh' => $quote->getRegularMarketDayHigh(),
            'previousClose' => $quote->getRegularMarketPreviousClose(),
            'differenceAmount' => $quote->getRegularMarketChange(),
            'differencePercent' => $quote->getRegularMarketChangePercent()
        ];
    }
}
