<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BookController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/get-books",
     *     security={{"bearerAuth":{}}},
     *     summary="List books",
     *     tags={"Books"},
     *     @OA\Response(response=200, description="Books listed")
     * )
     */

    public function index()
    {
        $books = Cache::remember('books', 60, function () {
            return Book::paginate(10);
        });

        return response()->json($books);
    }

    /**
     * @OA\Get(
     *     path="/api/get-book-details/{id}",
     *     summary="Get book details",
     *     tags={"Books"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Book details")
     * )
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return response()->json($book);
    }

    /**
     * @OA\Post(
     *     path="/api/store-book",
     *     summary="Add a new book",
     *     tags={"Books"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title","author","description"},
     *             @OA\Property(property="title", type="string", example="Clean Code"),
     *             @OA\Property(property="author", type="string", example="Robert C. Martin"),
     *             @OA\Property(property="description", type="string", example="A handbook of agile software craftsmanship")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Book created")
     * )
     */
    public function store(Request $request)
    {
        $this->authorize('create', Book::class);

        $data = $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'description' => 'nullable|string'
        ]);

        $book = Book::create($data);
        Cache::forget('books');

        return response()->json($book, 201);
    }

    /**
     * @OA\Post(
     *     path="/api/update-books/{id}",
     *     summary="Update book details",
     *     tags={"Books"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Book ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Updated Title"),
     *             @OA\Property(property="author", type="string", example="Updated Author"),
     *             @OA\Property(property="description", type="string", example="Updated description")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Book updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Book not found"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->validate([
            'title' => 'string|nullable',
            'author' => 'string|nullable',
            'description' => 'nullable|string'
        ]);

        $book->update($data);
        Cache::forget('books');

        return response()->json($book);
    }

    /**
     * @OA\Delete(
     *     path="/api/books/{id}",
     *     summary="Delete a book",
     *     tags={"Books"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the book to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Book deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Book not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        Cache::forget('books');

        return response()->json(null, 204);
    }
}
