<?php

namespace Dagim\LaraCraft;

use Illuminate\Support\ServiceProvider;
use Dagim\LaraCraft\Commands\InitCommand;
use Dagim\LaraCraft\Commands\GenerateCommand;
use Dagim\LaraCraft\Commands\GenerateUICommand;

class LaraCraftServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InitCommand::class,
                GenerateCommand::class,
                GenerateUICommand::class,
            ]);
        }

        $this->publishes([
            __DIR__.'/../config/lara-craft.php' => config_path('lara-craft.php'),
        ], 'lara-craft-config');

        $this->publishes([
            __DIR__.'/../resources/stubs' => resource_path('stubs/vendor/lara-craft'),
        ], 'lara-craft-stubs');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/lara-craft.php', 'lara-craft'
        );
    }
}

?>