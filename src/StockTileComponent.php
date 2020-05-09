<?php

namespace VitorHugoRo\StockTile;

use VitorHugoRo\StockTile\StockStore;
use Livewire\Component;

class StockTileComponent extends Component
{
    /** @var string */
    public $position;

    public function mount($position)
    {
        $this->position = $position;
    }

    public function render()
    {
        return view('livewire.stock-tile', [
            'stocks' => StockStore::make()->quotes(),
            'refreshIntervalInSeconds' => config('dashboard.tiles.stocks_data.refresh_interval_in_seconds') ?? 60,
        ]);
    }
}
