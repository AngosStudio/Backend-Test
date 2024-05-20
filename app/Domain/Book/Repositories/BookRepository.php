<?php

namespace App\Domain\Book\Repositories;

use App\Domain\Book\Models\Book;

class BookRepository
{
    public function create(array $data)
    {
        return Book::create($data);
    }

    public function findById(int $id)
    {
        return Book::find($id);
    }

    public function all()
    {
        return Book::all();
    }

    public function update(int $id, array $data)
    {
        $book = Book::find($id);
        $book->update($data);
        return $book;
    }

    public function delete(int $id)
    {
        return Book::find($id)->delete();
    }
}
