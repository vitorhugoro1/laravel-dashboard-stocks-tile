<?php

namespace VitorHugoRo\StockTile;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Spatie\Dashboard\Models\Tile;

class StockStore
{
    /** @var Tile */
    private $tile;

    public static function make()
    {
        return new static();
    }

    public function __construct()
    {
        $this->tile = Tile::firstOrCreateForName('stock_data');
    }

    public function setQuoteDataForStock(array $quotes): self
    {
        $this->tile->putData('stocks', $quotes);

        return $this;
    }

    public function quotes(): Collection
    {
        return collect($this->tile->getData('stocks') ?? [])
            ->map(function ($stock) {
                if (Arr::has($stock, 'now')) {
                    $stock['now'] = number_format($stock['now'], 2, ',', '.');
                }

                if (Arr::has($stock, 'differencePercent')) {
                    $stock['differencePercent'] = number_format($stock['differencePercent'], 2, ',', '.') . "%";
                }

                return $stock;
            });
    }
}
