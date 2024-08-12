<?php

namespace Tests\Feature;

use Tests\TestCase;
use PHPUnit\Metadata\RequiresPhpExtension;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

#[RequiresPhpExtension('pgsql')]
class SkippingTest extends TestCase
{
    protected function setUp(): void
    {
        if (!extension_loaded('pgsql')) {
            $this->markTestSkipped(
                'The PostgreSQL extension is not available',
            );
        }
    }

    public function testConnection(): void
    {
    }
}