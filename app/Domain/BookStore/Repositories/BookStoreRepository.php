<?php

namespace App\Domain\BookStore\Repositories;

use App\Domain\BookStore\Models\BookStore;

class BookStoreRepository
{
    public function all($store_id)
    {
        return BookStore::where('store_id', $store_id)->with(['store', 'book'])->get();
    }
}
