<?php

namespace Tests;

use Illuminate\Support\Facades\File;

class CommandTest extends TestCase
{
    protected function getEnvironmentSetUp($app)
    {
        $app->config['shiftable-config.overrides']      = __DIR__ . '/configs/simple_replacement_values.php';
        $app->config['shiftable-config.overrides_file'] = __DIR__ . '/configs/overrides.php';
    }

    /** @test */
    public function can_run_the_command()
    {
        $this->artisan('make:shiftable-configs')
            ->assertExitCode(0);

        $this->assertStringContainsString('An App By Any Other Name', File::get(__DIR__ . '/configs/overrides.php'));
    }
}
