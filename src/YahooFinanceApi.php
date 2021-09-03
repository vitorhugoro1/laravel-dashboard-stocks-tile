<?php

declare(strict_types=1);

namespace VitorHugoRo\StockTile;

use Scheb\YahooFinanceApi\ApiClient;

class YahooFinanceApi
{
    public function __construct(private ApiClient $client)
    {
    }

    public function getQuote(string $stock): ?array
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
            'differencePercent' => $quote->getRegularMarketChangePercent(),
        ];
    }
}
