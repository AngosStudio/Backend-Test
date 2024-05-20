<?php
namespace App\Domain\Store\Services;

use App\Domain\Book\Repositories\BookRepository;
use App\Domain\Store\Repositories\StoreRepository;
use Exception;

class StoreService
{
    protected $storeRepository;
    protected $bookRepository;

    public function __construct(StoreRepository $storeRepository, BookRepository $bookRepository)
    {
        $this->storeRepository = $storeRepository;
        $this->bookRepository = $bookRepository;
    }

    public function all()
    {
        return $this->storeRepository->all();
    }

    public function create(array $data)
    {
        return $this->storeRepository->create($data);
    }

    public function findById($id)
    {
        return $this->storeRepository->findById($id);
    }

    public function update($id, array $data)
    {
        $store = $this->storeRepository->findById($id);
        if (!$store) {
            throw new Exception("Store not found", 1);
        }
        $store->update($data);
        return $store;
    }

    public function delete($id)
    {
        $store = $this->storeRepository->findById($id);
        if (!$store) {
            throw new Exception("Store not found", 1);
        }
        $store->delete();
        return $store;
    }
}
