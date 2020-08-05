<?php

namespace Grosv\ShiftableConfigs;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class ShiftableConfigsProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(Config::get('app.shiftable_config_file') ?? __DIR__ . '/../config/config.php', 'shiftable-configs');

        $config = $this->app->make('config');

        foreach (config('shiftable-configs') as $k => $v) {
            $config->set($k, array_merge($config->get($k, []), $v));
        }
    }

    public function register(): void
    {
    }
}
