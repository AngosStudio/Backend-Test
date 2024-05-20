<?php
namespace App\Http\Controllers;

use App\Domain\Store\Requests\AddBookRequest;
use App\Domain\Store\Requests\CreateStoreRequest;
use App\Domain\Store\Requests\RemoveBookRequest;
use App\Domain\Store\Requests\UpdateStoreRequest;
use App\Domain\Store\Services\StoreService;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    private $storeService;
    public function __construct(StoreService $service)
    {
        $this->storeService = $service;
    }

    public function index()
    {
        try {
            $data = $this->storeService->all();

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

    public function store(CreateStoreRequest $request)
    {
        try {
            $store = $this->storeService->create($request->validated());

            return response()->json([
                'success' => true,
                'data' => $store,
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
            $store = $this->storeService->findById($id);
            if (!$store) {
                return response()->json([
                    'success' => false,
                    'error' => 'Store not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $store,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateStoreRequest $request, int $id)
    {
        try {
            $store = $this->storeService->update($id, $request->validated());
            if (!$store) {
                return response()->json([
                    'success' => false,
                    'error' => 'Store not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $store,
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
            $store = $this->storeService->delete($id);
            if (!$store) {
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

    public function addBook(AddBookRequest $request, int $store_id)
    {
        try {
            $this->storeService->addBook($store_id, $request->book_id);

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

    public function removeBook(RemoveBookRequest $request, int $store_id)
    {
        try {
            $this->storeService->removeBook($store_id, $request->book_id);

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
