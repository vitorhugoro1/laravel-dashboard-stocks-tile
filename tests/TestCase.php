<?php

declare(strict_types=1);

namespace VitorHugoRo\StockTile\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use VitorHugoRo\StockTile\StockServiceProvider;
use Illuminate\Support\Facades\View;

class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            StockServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', 'base64:Hupx3yAySikrM2/edkZQNQHslgDWYfiBfCuSThJ5SK8=');

        View::addLocation(__DIR__ . '/resources/views');
    }
}
