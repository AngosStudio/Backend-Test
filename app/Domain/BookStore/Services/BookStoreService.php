<?php
namespace App\Domain\BookStore\Services;

use App\Domain\Book\Repositories\BookRepository;
use App\Domain\BookStore\Repositories\BookStoreRepository;
use App\Domain\Store\Repositories\StoreRepository;
use Exception;

class BookStoreService
{
    protected $storeRepository;
    protected $bookStoreRepository;
    protected $bookRepository;

    public function __construct(BookStoreRepository $bookStoreRepository, StoreRepository $storeRepository, BookRepository $bookRepository)
    {
        $this->bookStoreRepository = $bookStoreRepository;
        $this->storeRepository = $storeRepository;
        $this->bookRepository = $bookRepository;
    }

    public function all($store_id)
    {
        return $this->bookStoreRepository->all($store_id);
    }

    public function storeBook($store_id, $book_id)
    {
        $store = $this->storeRepository->findById($store_id);
        if (!$store) {
            throw new Exception("Store not found", 1);
        }

        $book = $this->bookRepository->findById($book_id);
        if (!$book) {
            throw new Exception("Book not found", 1);
        }

        return $store->books()->attach($book);
    }

    public function deleteBook($store_id, $book_id)
    {
        $store = $this->storeRepository->findById($store_id);
        if (!$store) {
            throw new Exception("Store not found", 1);
        }

        $book = $this->bookRepository->findById($book_id);
        if (!$book) {
            throw new Exception("Book not found", 1);
        }

        if (!$book->stores()->where('store_id', $store->id)->exists()) {
            throw new Exception('This book was not associated with this store.', 1);
        }

        return $store->books()->detach($book);
    }
}
