<?php

namespace App\Models;

use App\Models\Book;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps=true;
    protected $table='categories';
    protected $perPage=12;
    
    protected $fillable = [
        'name'
      , 'slug'
    ];

    protected $hidden = [];
    protected $casts = [];
    
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    /**
     * @note    mutators only work with Eloquent, and not with Laravel's Query Builder
     */
    
}
