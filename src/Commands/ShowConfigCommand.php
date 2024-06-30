<?php

namespace Hexafuchs\DynamicArtisanServiceProvider\Commands;

use Illuminate\Foundation\Console\ConfigShowCommand as Command;

class ShowConfigCommand extends Command
{
    public function handle(): int
    {
        if (! app()->environment('testing') || ! config('testing.dynamic_artisan', false)) {
            return parent::handle();
        }

        $this->warn('Disabled');

        return 2;
    }
}
