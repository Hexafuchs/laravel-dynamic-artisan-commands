<?php

namespace Hexafuchs\DynamicArtisanServiceProvider;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Database\MigrationServiceProvider;
use Illuminate\Foundation\Providers\ComposerServiceProvider;
use Illuminate\Foundation\Providers\ConsoleSupportServiceProvider;

class DynamicConsoleSupportServiceProvider extends ConsoleSupportServiceProvider implements DeferrableProvider
{
    protected $providers = [
        DynamicArtisanServiceProvider::class,
        MigrationServiceProvider::class,
        ComposerServiceProvider::class,
    ];
}
