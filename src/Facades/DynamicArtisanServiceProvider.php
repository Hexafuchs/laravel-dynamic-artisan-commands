<?php

namespace Hexafuchs\DynamicArtisanServiceProvider\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Hexafuchs\DynamicArtisanServiceProvider\DynamicArtisanServiceProvider
 */
class DynamicArtisanServiceProvider extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Hexafuchs\DynamicArtisanServiceProvider\DynamicArtisanServiceProvider::class;
    }
}
