<?php

namespace Tests\Feature;

use Tests\TestCase;
use InvalidArgumentException;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Controllers\tests\TestController;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExceptionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testGreetThrowsExceptionWhenNameIsEmpty(): void
    {
        $greeter = new TestController();

        // Expect an InvalidArgumentException to be thrown
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Name cannot be empty');

        // Call the method that should trigger the exception
        $greeter->greet('');
    }
}
