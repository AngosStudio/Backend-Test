<?php
namespace App\Domain\Store\Models;

use App\Domain\Book\Models\Book;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'active'];

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
