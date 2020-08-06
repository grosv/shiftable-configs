<?php

namespace Grosv\ShiftableConfigs;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Symfony\Component\VarExporter\VarExporter;

class GenerateShiftableConfigsCommand extends Command
{
    protected $signature = 'make:shiftable-configs';

    public function handle(Configurations $configurations)
    {
        $versions = [5.5, 5.6, 5.7, 5.8, 6.0, 7.0];

        $laravel = explode('.', preg_replace('/[^0-9.]/', '',
            json_decode(File::get(base_path('/composer.json')), true)['require']['laravel/framework']));

        $version = join('.', array_slice($laravel, 0, 2));

        foreach ($versions as $v) {
            if ($v >= (float) $version) {
                break;
            }
        }

        $configurations->defaults($v);

        $overrides = [];

        foreach (Arr::dot(config('default_configs')) as $k => $v) {
            if (Config::get($k) != Config('default_configs.' . $k)) {
                Arr::set($overrides, $k, Config::get($k));
            }
        }

        File::put(config('shiftable-config.overrides_file'), "<?php\n\nreturn " . VarExporter::export($overrides) . ';');

        return 0;
    }
}
