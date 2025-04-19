<?php

namespace Tests\Unit;

use App\Models\Book;
use Tests\TestCase;

class BookTest extends TestCase
{
    /**
     * Test if the book is available.
     *
     * @return void
     */
    public function testBookIsAvailable()
    {
        $book = Book::create([
            'title' => 'Sample Book',
            'author' => 'John Doe',
            'description' => 'A sample description',
            'is_borrowed' => false
        ]);

        $this->assertTrue($book->isAvailable());
    }
}
