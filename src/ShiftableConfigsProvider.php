<?php

namespace Grosv\ShiftableConfigs;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class ShiftableConfigsProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(Config::get('app.shiftable_config_file') ?? __DIR__ . '/../config/config.php', 'shiftable-configs');

        foreach (Arr::dot(config('shiftable-configs')) as $k => $v) {
            Config::set($k, $v);
        }

        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('shiftable-configs.php'),
        ]);
    }

    public function register(): void
    {
    }
}
