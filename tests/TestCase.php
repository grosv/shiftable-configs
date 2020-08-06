<?php

namespace Tests;

use Grosv\ShiftableConfigs\ShiftableConfigsProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        touch(__DIR__ . '/configs/overrides.php');
    }

    public function tearDown(): void
    {
        parent::tearDown();
        unlink(__DIR__ . '/configs/overrides.php');
    }

    protected function getPackageProviders($app)
    {
        return [ShiftableConfigsProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('app.key', 'base64:r0w0xC+mYYqjbZhHZ3uk1oH63VadA3RKrMW52OlIDzI=');
    }
}
