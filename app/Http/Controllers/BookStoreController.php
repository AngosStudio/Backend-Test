<?php
namespace App\Http\Controllers;

use App\Domain\BookStore\Requests\AddBookRequest;
use App\Domain\BookStore\Services\BookStoreService;
use App\Http\Controllers\Controller;

class BookStoreController extends Controller
{
    private $bookStoreService;
    public function __construct(BookStoreService $service)
    {
        $this->bookStoreService = $service;
    }

    public function index(int $store_id)
    {
        try {
            $data = $this->bookStoreService->all($store_id);

            return response()->json([
                'success' => true,
                'data' => $data,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ], 500);
        }

    }

    public function store(AddBookRequest $request)
    {
        try {
            $validated = $request->validated();

            $this->bookStoreService->storeBook($validated['store_id'], $validated['book_id']);

            return response()->json([
                'success' => true,
                'message' => 'Book added to store successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function delete(int $store_id, int $book_id)
    {
        try {

            $this->bookStoreService->deleteBook($store_id, $book_id);

            return response()->json([
                'success' => true,
                'message' => 'Book removed from store successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
