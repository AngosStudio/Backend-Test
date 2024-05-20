<?php

namespace App\Domain\Store\Repositories;

use App\Domain\Store\Models\Store;

class StoreRepository
{
    public function create(array $data)
    {
        return Store::create($data);
    }

    public function findById(int $id)
    {
        return Store::find($id);
    }

    public function all()
    {
        return Store::all();
    }

    public function update(int $id, array $data)
    {
        $store = Store::find($id)->update($data);
        return $store;
    }

    public function delete(int $id)
    {
        return Store::find($id)->delete();
    }
}
