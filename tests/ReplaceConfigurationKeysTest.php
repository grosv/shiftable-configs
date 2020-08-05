<?php

namespace Tests;

use Illuminate\Support\Facades\Config;

class ReplaceConfigurationKeysTest extends TestCase
{
    protected function getEnvironmentSetUp($app)
    {
        $app->config['app.shiftable_config_file'] = __DIR__ . '/configs/simple_replacement_values.php';
    }

    /** @test */
    public function can_override_the_config_location_for_tests()
    {
        $this->assertSame('An App By Any Other Name', config('app.name'));
    }
}
