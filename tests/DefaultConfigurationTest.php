<?php

namespace Tests;

use Illuminate\Support\Facades\Config;

class DefaultConfigurationTest extends TestCase
{
    /** @test */
    public function default_configuration_is_sane()
    {
        $this->assertSame('Laravel', config('app.name'));
    }
}
