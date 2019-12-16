<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function initDB()
    {
        config([
            'database.default' => 'sqlite_testing',
        ]);

        $this->artisan('migrate');
        $this->artisan('db:seed');
    }

    protected function resetDB()
    {
        $this->artisan('migrate:reset');
    }

    public static function setUpBeforeClass()
    {
        $_ENV['DB_CONNECTION'] = 'sqlite_testing';
    }
}
