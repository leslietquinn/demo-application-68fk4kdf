<?php

namespace App\Models;

use App\Models\Author;
use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public $timestamps=true;
    protected $table='books';
    protected $perPage=12;
    
    protected $fillable = [
        'name'
      , 'author_id'
      , 'category_id'
    ];

    protected $hidden = [];
    protected $casts = [];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

}
