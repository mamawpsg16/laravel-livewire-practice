<?php

namespace Tests\Feature\Fixtures;

use Tests\TestCase;
use App\Models\TestUser;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FixturesTest extends TestCase
{
    use RefreshDatabase;

    public function test_example()
    {
        // Create a user using the factory
        $user = TestUser::factory()->create();

        $this->assertDatabaseHas('test_users', [
            'email' => $user->email,
        ]);
    }
}
