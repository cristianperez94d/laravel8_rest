<?php

namespace App\Models;

use App\Models\Author;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    public $resource = BookResource::class;
    public $resourceCollection = BookCollection::class;
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
