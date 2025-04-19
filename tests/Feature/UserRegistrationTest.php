<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    /**
     * Test user registration.
     *
     * @return void
     */
    public function testUserRegistration()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@user.com',
            'password' => 'password123',
            'role' => 'user'
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'user' => ['id', 'name', 'email'],
                'token'
            ]);

    }
}
