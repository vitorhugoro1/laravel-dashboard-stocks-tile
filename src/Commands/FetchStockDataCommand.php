<?php

namespace VitorHugoRo\StockTile\Commands;

use Illuminate\Console\Command;
use VitorHugoRo\StockTile\StockStore;
use VitorHugoRo\StockTile\YahooFinanceApi;

class FetchStockDataCommand extends Command
{
    protected $signature = 'dashboard:fetch-stock-data';

    protected $description = 'Fetch data for all selected stocks data';

    public function handle(YahooFinanceApi $yahooFinanceApi)
    {
        $this->info("Fetching stocks most recent prices...");
        $quotes = collect();

        foreach (config('dashboard.tiles.stocks_data.stocks') ?? [] as $stock) {
            $stockQuote = $yahooFinanceApi->getQuote($stock);

            if (! $stockQuote) {
                continue;
            }

            $quotes->push($stockQuote);
        }

        StockStore::make()->setQuoteDataForStock($quotes->toArray());
        $this->info("All done!");
    }
}
