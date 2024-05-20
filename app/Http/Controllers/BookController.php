<?php
namespace App\Http\Controllers;

use App\Domain\Book\Requests\CreateBookRequest;
use App\Domain\Book\Requests\UpdateBookRequest;
use App\Domain\Book\Services\BookService;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    private $bookService;
    public function __construct(BookService $service)
    {
        $this->bookService = $service;
    }

    public function index()
    {
        try {
            $data = $this->bookService->all();

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

    public function store(CreateBookRequest $request)
    {
        try {
            $book = $this->bookService->create($request->validated());

            return response()->json([
                'success' => true,
                'data' => $book,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function show(int $id)
    {
        try {
            $book = $this->bookService->findById($id);
            if (!$book) {
                return response()->json([
                    'success' => false,
                    'error' => 'Book not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $book,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateBookRequest $request, int $id)
    {
        try {
            $book = $this->bookService->update($id, $request->validated());
            if (!$book) {
                return response()->json([
                    'success' => false,
                    'error' => 'Store not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $book,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function destroy(int $id)
    {
        try {
            $book = $this->bookService->delete($id);
            if (!$book) {
                return response()->json([
                    'success' => false,
                    'error' => 'Store not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
            ], 204);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
