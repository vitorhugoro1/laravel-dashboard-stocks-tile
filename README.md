# Laravel Dashboard Finance Stocks Tile

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vitorhugoro1/laravel-dashboard-stocks-tile.svg?style=flat-square)](https://packagist.org/packages/vitorhugoro1/laravel-dashboard-stocks-tile)
[![Total Downloads](https://img.shields.io/packagist/dt/vitorhugoro1/laravel-dashboard-stocks-tile.svg?style=flat-square)](https://packagist.org/packages/vitorhugoro1/laravel-dashboard-stocks-tile)

A tile who fetch stock data price information from Yahoo Finance!

This tile can be used on [the Laravel Dashboard](https://docs.spatie.be/laravel-dashboard).

## Installation

You can install the package via composer:

```bash
composer require vitorhugoro1/laravel-dashboard-stocks-tile
```

## Usage

In the `dashboard` config file, you must add this configuration in the `tiles` key.

```php
// in config/dashboard.php
return [
    // ...
    'tiles' => [
        'stocks_data' => [
            'stocks' => [
                'AAPL' // Use the yahoo stock symbols format
            ],
            'refresh_interval_in_seconds' => 60,
        ],
    ],
];
```

In app\Console\Kernel.php you should schedule the VitorHugoRo\StockTile\Commands\FetchStockDataCommand to run every minute.

In your dashboard view you use the `livewire:stock-tile` component.

```html
<x-dashboard>
    <livewire:stock-tile position="e7:e16"/>
</x-dashboard>
```

## Todo items

- [ ] Adding custom title to tile component
- [ ] Make tests to livewire tile
- [x] Make tests to data fetch

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email vitorhugo.ro10@gmail.com instead of using the issue tracker.

## Credits

- [Vitor Merencio](https://github.com/vitorhugoro1)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
