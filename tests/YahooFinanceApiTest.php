<?php

declare(strict_types=1);

namespace VitorHugoRo\StockTile\Tests;

use Livewire\LivewireServiceProvider;
use Scheb\YahooFinanceApi\ApiClient;
use Scheb\YahooFinanceApi\Results\Quote;
use VitorHugoRo\StockTile\YahooFinanceApi;
use VitorHugoRo\StockTile\StockServiceProvider;

class YahooFinanceApiTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            StockServiceProvider::class,
            LivewireServiceProvider::class
        ];
    }

    public function testShouldReturnStockMappedData()
    {
        $expectedQuote = [
            "language" => "en-US",
            "region" => "US",
            "quoteType" => "EQUITY",
            "quoteSourceName" => "Delayed Quote",
            "triggerable" => true,
            "currency" => "USD",
            "exchange" => "NMS",
            "longName" => "Apple Inc.",
            "messageBoardId" => "finmb_24937",
            "exchangeTimezoneName" => "America/New_York",
            "exchangeTimezoneShortName" => "EDT",
            "gmtOffSetMilliseconds" => -14400000,
            "market" => "us_market",
            "esgPopulated" => false,
            "shortName" => "Apple Inc.",
            "firstTradeDateMilliseconds" => 345479400000,
            "earningsTimestamp" => 1627403400,
            "earningsTimestampStart" => 1635332340,
            "earningsTimestampEnd" => 1635768000,
            "trailingAnnualDividendRate" => 0.835,
            "trailingPE" => 30.080267,
            "trailingAnnualDividendYield" => 0.005475051,
            "epsTrailingTwelveMonths" => 5.108,
            "epsForward" => 5.67,
            "epsCurrentYear" => 5.58,
            "priceEpsCurrentYear" => 27.535841,
            "sharesOutstanding" => 16530199552,
            "bookValue" => 3.882,
            "fiftyDayAverage" => 147.68257,
            "fiftyDayAverageChange" => 5.9674225,
            "fiftyDayAverageChangePercent" => 0.040407088,
            "twoHundredDayAverage" => 133.59209,
            "twoHundredDayAverageChange" => 20.057907,
            "twoHundredDayAverageChangePercent" => 0.15014292,
            "marketCap" => 2539864981504,
            "forwardPE" => 27.098764,
            "priceToBook" => 39.580112,
            "sourceInterval" => 15,
            "exchangeDataDelayedBy" => 0,
            "averageAnalystRating" => "1.9 - Buy",
            "tradeable" => false,
            "priceHint" => 2,
            "postMarketChangePercent" => -0.039048202,
            "postMarketTime" => 1630627199,
            "postMarketPrice" => 153.59,
            "postMarketChange" => -0.05999756,
            "regularMarketChange" => 1.1399994,
            "regularMarketChangePercent" => 0.7474916,
            "regularMarketTime" => 1630612802,
            "regularMarketPrice" => 153.65,
            "regularMarketDayHigh" => 154.72,
            "regularMarketDayRange" => "152.4 - 154.72",
            "regularMarketDayLow" => 152.4,
            "regularMarketVolume" => 71171317,
            "regularMarketPreviousClose" => 152.51,
            "bid" => 153.66,
            "ask" => 153.6,
            "bidSize" => 10,
            "askSize" => 8,
            "fullExchangeName" => "NasdaqGS",
            "financialCurrency" => "USD",
            "regularMarketOpen" => 153.87,
            "averageDailyVolume3Month" => 77182942,
            "averageDailyVolume10Day" => 67091414,
            "fiftyTwoWeekLowChange" => 50.549995,
            "fiftyTwoWeekLowChangePercent" => 0.49030066,
            "fiftyTwoWeekRange" => "103.1 - 154.98",
            "fiftyTwoWeekHighChange" => -1.3300018,
            "fiftyTwoWeekHighChangePercent" => -0.008581765,
            "fiftyTwoWeekLow" => 103.1,
            "fiftyTwoWeekHigh" => 154.98,
            "dividendDate" => 1628726400,
            "marketState" => "POSTPOST",
            "displayName" => "Apple",
            "symbol" => "AAPL",
        ];

        $apiClientMock = $this->createMock(ApiClient::class);

        $apiClientMock->expects($this->once())
            ->method('getQuote')
            ->with($this->equalTo("AAPL"))
            ->willReturn(new Quote($expectedQuote));

        $this->app->bind(ApiClient::class, fn () => $apiClientMock);

        $service = $this->app->get(YahooFinanceApi::class);

        $quote = $service->getQuote("AAPL");

        $this->assertEquals([
            'name' => $expectedQuote['longName'],
            'symbol' => $expectedQuote['symbol'],
            'isMarketOpen' => $expectedQuote['marketState'],
            'now' => $expectedQuote['regularMarketPrice'],
            'dayLow' => $expectedQuote['regularMarketDayLow'],
            'dayHigh' => $expectedQuote['regularMarketDayHigh'],
            'previousClose' => $expectedQuote['regularMarketPreviousClose'],
            'differenceAmount' => $expectedQuote['regularMarketChange'],
            'differencePercent' => $expectedQuote['regularMarketChangePercent'],
        ], $quote);
    }

    public function testNotCanFoundStockDataThenReturnNull()
    {
        $apiClientMock = $this->createMock(ApiClient::class);

        $apiClientMock->expects($this->once())
            ->method('getQuote')
            ->with($this->equalTo("AAPL"))
            ->willReturn(null);

        $this->app->bind(ApiClient::class, fn () => $apiClientMock);

        $service = $this->app->get(YahooFinanceApi::class);

        $quote = $service->getQuote("AAPL");

        $this->assertNull($quote);
    }
}
