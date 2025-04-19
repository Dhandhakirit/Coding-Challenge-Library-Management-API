<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AdminBookCreationTest extends TestCase
{
    /**
     * Test if admin can create a book.
     *
     * @return void
     */
    public function test_admin_can_create_book()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin, 'api')->postJson('/api/books', [
            'title' => 'New Book',
            'author' => 'Jane Doe',
            'description' => 'A new book description',
        ]);

        $response->assertStatus(201); // this is where it’s failing
    }



    /**
     * Test if a regular user cannot create a book.
     *
     * @return void
     */
    public function testUserCannotCreateBook()
    {
        $user = User::factory()->create(['role' => 'user']);
        
        $response = $this->actingAs($user)->postJson('/api/store-book', [
            'title' => 'New Book',
            'author' => 'Jane Doe',
            'description' => 'A new book description'
        ]);

        $response->assertStatus(403);  // Forbidden for users
    }
}
