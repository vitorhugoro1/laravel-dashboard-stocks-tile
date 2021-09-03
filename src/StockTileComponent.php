<?php

declare(strict_types=1);

namespace VitorHugoRo\StockTile;

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
        return view('dashboard-stock-tile::tile', [
            'stocks' => StockStore::make()->quotes(),
            'refreshIntervalInSeconds' => config('dashboard.tiles.stocks_data.refresh_interval_in_seconds') ?? 60,
        ]);
    }
}
