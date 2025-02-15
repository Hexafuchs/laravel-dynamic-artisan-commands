<?php

namespace Hexafuchs\DynamicArtisanServiceProvider\Tests;

use Hexafuchs\DynamicArtisanServiceProvider\DynamicArtisanServiceProvider;
use Hexafuchs\DynamicArtisanServiceProvider\DynamicConsoleSupportServiceProvider;
use Hexafuchs\DynamicArtisanServiceProvider\PackageServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            PackageServiceProvider::class,
            DynamicConsoleSupportServiceProvider::class,
            DynamicArtisanServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');
        config()->set('testing.dynamic_artisan', true);
    }
}
