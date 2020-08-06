<?php

namespace Grosv\ShiftableConfigs;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class Configurations
{
    public function defaults($version = '7.0')
    {
        $config = app()->make('config');
        foreach (File::files(__DIR__ . '/../config/' . $version . '/') as $file) {
            $config->set('default_configs.' . $file->getFilenameWithoutExtension(), include($file->getPathname()));
        }
    }

    public function custom()
    {
        foreach (Arr::dot(config('shiftable-config-overrides')) as $k => $v) {
            if (!Config::has($k) || !is_array(Config::get($k))) {
                Config::set($k, $v);
            } else {
                Config::set($k, Config::get($k) + $v);
            }
        }
    }
}
