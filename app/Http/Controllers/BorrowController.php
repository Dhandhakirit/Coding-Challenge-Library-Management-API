<?php

namespace App\Http\Controllers;

use App\Events\BookBorrowed;
use App\Events\BookReturned;
use App\Models\Book;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/books/{id}/borrow",
     *     summary="Borrow a book",
     *     tags={"Borrowing"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Book borrowed")
     * )
     */
    public function borrow(Book $book)
    {
        if ($book->is_borrowed) {
            return response()->json(['message' => 'Book already borrowed'], 400);
        }

        $book->update(['is_borrowed' => true]);
        event(new BookBorrowed($book, auth()->user()));

        return response()->json(['message' => 'Book borrowed by ' . auth()->user()->name]);
    }

    /**
     * @OA\Post(
     *     path="/api/books/{id}/return",
     *     summary="Return a book",
     *     tags={"Borrowing"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Book returned")
     * )
     */
    public function return(Book $book)
    {
        if (! $book->is_borrowed) {
            return response()->json(['message' => 'Book not borrowed'], 400);
        }

        $book->update(['is_borrowed' => false]);
        event(new BookReturned($book, auth()->user()));

        return response()->json(['message' => 'Book returned by ' . auth()->user()->name]);
    }
}
