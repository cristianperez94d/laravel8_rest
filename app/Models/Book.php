<?php

namespace App\Models;

use App\Models\Author;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'cover',
    ];

    public function authors() {
        return $this->hasMany(Author::class, 'book_id');
    }

}
