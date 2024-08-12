<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\tests\TestController;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GreeterTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_greets_with_name(): void
    {
        $greeter = new TestController();

        $greeting = $greeter->greet('Alice');

        $this->assertSame('Hello, Alice!', $greeting);
    }
}
