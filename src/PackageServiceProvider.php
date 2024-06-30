<?php

namespace Hexafuchs\DynamicArtisanServiceProvider;

use Hexafuchs\DynamicArtisanServiceProvider\Commands\ShowConfigCommand as NewShowConfigCommand;
use Illuminate\Foundation\Console\ConfigShowCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider as ServiceProvider;

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
        if (app()->environment('testing')) {
            DynamicArtisanServiceProvider::registerCommand('ConfigShow', ConfigShowCommand::class, NewShowConfigCommand::class, true);
        }
    }
}
