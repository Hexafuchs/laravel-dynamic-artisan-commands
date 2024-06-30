<?php

namespace Hexafuchs\DynamicArtisanServiceProvider;

use Illuminate\Foundation\Console\ConfigShowCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider as ServiceProvider;
use Hexafuchs\DynamicArtisanServiceProvider\Commands\ShowConfigCommand as NewShowConfigCommand;

class PackageServiceProvider extends ServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-dynamic-artisan-commands');
    }

    public function registeringPackage(): void
    {
    }

}
