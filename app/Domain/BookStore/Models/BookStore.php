<?php

namespace App\Domain\BookStore\Models;

use App\Domain\Book\Models\Book;
use App\Domain\Store\Models\Store;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookStore extends Model
{
    use HasFactory;

    protected $table = "book_store";

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
