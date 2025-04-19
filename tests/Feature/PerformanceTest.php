<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class PerformanceTest extends TestCase
{
    /**
     * Test the response time for getting books.
     *
     * @return void
     */
    public function testGetBooksPerformance()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson('/api/get-books');

        $response->assertStatus(200);
        $this->assertLessThan(500, $response->getDuration());
    }

}
