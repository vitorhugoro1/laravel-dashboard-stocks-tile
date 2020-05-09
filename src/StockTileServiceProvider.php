<?php

namespace VitorHugoRo\StockTile;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use VitorHugoRo\StockTile\Commands\FetchStockDataCommand;

class StockServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FetchStockDataCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/dashboard-stock-tile'),
        ], 'dashboard-stock-tile-views');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'dashboard-stock-tile');

        Livewire::component('stock-tile', StockTileComponent::class);
    }
}
