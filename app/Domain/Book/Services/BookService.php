<?php
namespace App\Domain\Book\Services;

use App\Domain\Book\Repositories\BookRepository;
use Exception;

class BookService
{
    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function all()
    {
        return $this->bookRepository->all();
    }

    public function create(array $data)
    {
        return $this->bookRepository->create($data);
    }

    public function findById($id)
    {
        return $this->bookRepository->findById($id);
    }

    public function update($id, array $data)
    {
        $book = $this->bookRepository->findById($id);
        if (!$book) {
            throw new Exception("Book not found", 1);
        }
        $book->update($data);
        return $book;
    }

    public function delete($id)
    {
        $book = $this->bookRepository->findById($id);
        if (!$book) {
            throw new Exception("Book not found", 1);
        }
        $book->delete();
        return $book;
    }
}
