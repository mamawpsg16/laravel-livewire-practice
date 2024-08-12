<?php

namespace Tests\Feature\Fixtures;
// tests/TestCase.php

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Run the migrations and seeders
        Artisan::call('migrate');
        Artisan::call('db:seed');

    }
}
