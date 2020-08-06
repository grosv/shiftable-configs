<?php

namespace Grosv\ShiftableConfigs;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class ShiftableConfigsProvider extends ServiceProvider
{
    public function boot(Configurations $configurations): void
    {
        $this->mergeConfigFrom(Config::get('shiftable-config.overrides') ?? __DIR__ . '/../config/overrides.php', 'shiftable-config-overrides');
        $configurations->custom();

        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('shiftable-configs.php'),
        ]);

        $this->commands([
            GenerateShiftableConfigsCommand::class,
        ]);
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'shiftable-config');
    }
}
