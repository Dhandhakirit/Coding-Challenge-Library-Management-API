<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Tests\TestCase;

class BorrowBookTest extends TestCase
{
    /**
     * Test borrowing a book.
     *
     * @return void
     */
    public function testBorrowBook()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $book = Book::create([
            'title' => 'Sample Book',
            'author' => 'John Doe',
            'description' => 'A sample description',
            'is_borrowed' => false
        ]);

        $response = $this->actingAs($user)->postJson("/api/books/{$book->id}/borrow");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Book borrowed by ' . $user->name]);

        $book->refresh();
        $this->assertTrue($book->is_borrowed);
    }
}
